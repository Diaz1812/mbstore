<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class TestimonialService
{
    private string $path;

    public function __construct()
    {
        $folder = storage_path('app/data');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $this->path = $folder.'/testimonials.json';

        if (!File::exists($this->path)) {
            File::put($this->path, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    public function all()
    {
        return json_decode(File::get($this->path), true) ?? [];
    }

    public function approved()
    {
        return array_values(array_filter(
            $this->all(),
            fn($item)=>$item['status']=="approved"
        ));
    }

    public function find($id)
    {
        foreach($this->all() as $item){

            if($item['id']==$id){

                return $item;

            }

        }

        return null;
    }

    public function create($data)
    {
        $items=$this->all();

        $data['id']=$this->nextId();

        $data['status']='pending';

        $data['created_at']=now()->format('Y-m-d H:i:s');

        $items[]=$data;

        $this->save($items);
    }

    public function update($id,$data)
    {
        $items=$this->all();

        foreach($items as &$item){

            if($item['id']==$id){

                $item=array_merge($item,$data);

                break;

            }

        }

        $this->save($items);
    }

    public function delete($id)
    {
        $items=array_filter(

            $this->all(),

            fn($item)=>$item['id']!=$id

        );

        $this->save(array_values($items));
    }

    private function nextId()
    {
        $items=$this->all();

        if(empty($items))
            return 1;

        return max(array_column($items,'id'))+1;
    }

    private function save($items)
    {
        File::put(

            $this->path,

            json_encode(
                $items,
                JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE
            )

        );
    }
}