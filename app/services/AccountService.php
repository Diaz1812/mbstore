<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class AccountService
{
    private string $path;

    public function __construct()
    {
        $folder = storage_path('app/data');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $this->path = $folder . '/accounts.json';

        if (!File::exists($this->path)) {
            File::put($this->path, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    public function all(): array
    {
        return json_decode(File::get($this->path), true) ?? [];
    }

    public function find(int $id): ?array
{
    foreach ($this->all() as $account) {

        if ($account['id'] == $id) {
            return $account;
        }

    }

    return null;
}


    public function create(array $data): void
    {
        $accounts = $this->all();

        $data['id'] = $this->nextId();

        $data['gallery'] = $data['gallery'] ?? [];

        $data['ml'] = $data['ml'] ?? null;

        $data['created_at'] = now()->format('Y-m-d H:i:s');

        $accounts[] = $data;

        $this->save($accounts);
    }

    

    public function update(int $id, array $data): void
    {
        $accounts = $this->all();

        foreach ($accounts as &$account) {

            if ($account['id'] == $id) {

                $account = array_merge($account, $data);

                break;
            }
        }

        $this->save($accounts);
    }

    public function delete(int $id): void
    {
        $accounts = array_filter(
            $this->all(),
            fn($item) => $item['id'] != $id
        );

        $this->save(array_values($accounts));
    }

    private function nextId(): int
    {
        $accounts = $this->all();

        if (empty($accounts)) {
            return 1;
        }

        return max(array_column($accounts, 'id')) + 1;
    }

    private function save(array $accounts): void
    {
        File::put(
            $this->path,
            json_encode($accounts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
}