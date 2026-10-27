<?php

namespace App\Http\Controllers;

use App\Support\DummyStore;
use Illuminate\Http\Request;

abstract class DummyCrudController extends Controller
{
    abstract protected function cfg(): array;

    protected function rows(): array
    {
        $config = $this->cfg();

        return DummyStore::get(
            $config['key'],
            $config['default']
        );
    }

    protected function save(array $rows): void
    {
        DummyStore::save($this->cfg()['key'], $rows);
    }

    protected function extras(): array
    {
        return [];
    }

    protected function enrich(array $data): array
    {
        return $data;
    }

    protected function toObject(array $row): object
    {
        $item = (object) $row;

        if (isset($row['nama_lengkap'])) {
            $item->user = (object) [
                'name' => $row['nama_lengkap'],
                'nama_lengkap' => $row['nama_lengkap'],
            ];
        }

        return $item;
    }

    public function index(Request $request)
    {
        $config = $this->cfg();
        $keyword = trim((string) $request->query('keyword', ''));

        $rows = $this->rows();

        if ($keyword !== '') {
            $rows = array_values(array_filter(
                $rows,
                fn ($row) => stripos(
                    json_encode($row, JSON_UNESCAPED_UNICODE),
                    $keyword
                ) !== false
            ));
        }

        $variable = $config['variable'];

        return view(
            $config['folder'] . '.index',
            array_merge(
                [
                    $variable => array_map(
                        fn ($row) => $this->toObject($row),
                        $rows
                    ),
                    'keyword' => $keyword,
                ],
                $this->extras()
            )
        );
    }

    public function create()
    {
        return view(
            $this->cfg()['folder'] . '.create',
            $this->extras()
        );
    }

    public function store(Request $request)
    {
        $config = $this->cfg();
        $data = $request->validate($config['rules']);
        $rows = $this->rows();

        foreach ($rows as $row) {
            if (
                isset($row[$config['id']]) &&
                (string) $row[$config['id']] ===
                (string) $data[$config['id']]
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        $config['id'] => 'Kode atau nomor sudah digunakan.',
                    ]);
            }
        }

        $data = array_merge($config['defaults'] ?? [], $data);
        $rows[] = $this->enrich($data);

        $this->save($rows);

        return redirect()
            ->route($config['route'] . '.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $config = $this->cfg();
        $found = null;

        foreach ($this->rows() as $row) {
            if ((string) $row[$config['id']] === (string) $id) {
                $found = $row;
                break;
            }
        }

        abort_if($found === null, 404);

        return view(
            $config['folder'] . '.edit',
            array_merge(
                [$config['singular'] => $this->toObject($found)],
                $this->extras()
            )
        );
    }

    public function update(Request $request, $id)
    {
        $config = $this->cfg();
        $data = $request->validate($config['rules']);
        $rows = $this->rows();
        $found = false;

        foreach ($rows as &$row) {
            if ((string) $row[$config['id']] === (string) $id) {
                $row = $this->enrich(array_merge($row, $data));
                $found = true;
                break;
            }
        }

        unset($row);
        abort_if(!$found, 404);

        $this->save($rows);

        return redirect()
            ->route($config['route'] . '.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $config = $this->cfg();
        $rows = $this->rows();

        $updated = array_values(array_filter(
            $rows,
            fn ($row) =>
                (string) $row[$config['id']] !== (string) $id
        ));

        abort_if(count($updated) === count($rows), 404);

        $this->save($updated);

        return redirect()
            ->route($config['route'] . '.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}