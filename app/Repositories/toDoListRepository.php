<?php

namespace App\Repositories;
use App\Models\toDoList;

class toDoListRepository{

    public function getAll(){
        // return 'something';
        return toDoList::all();
    }

    public function delete($id){
        $task = toDoList::findOrFail($id);
       

        $task->delete();
    }

}

