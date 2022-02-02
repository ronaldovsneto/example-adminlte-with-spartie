<?php
 namespace App\Traits;

 Trait Permission{

     private $actions = [
        'list'      => 'index' ,
        'edit'      => ['edit', 'update'] ,
        'show'      => 'show',
        'add'       => ['create', 'store'],
        'delete'    => 'destroy',
     ];

     public function callAction($method, $parameters)
     {
         $permissions = $this->config['permissions'];
         $free = true;

         foreach ($this->actions as $action => $value) {
             if (is_array($value)){
                 foreach ($value as $key => $val){
                     if ($val == $method){
                         $free = false;
                         if (auth()->user()->can($permissions[$val])){
                             $this->authorize($permissions[$val]);
                             return parent::callAction($method, $parameters);
                         }
                     }
                 }
             }else{
                 if ($value == $method){
                     $free = false;
                     if (auth()->user()->can($permissions[$action])){
                         $this->authorize($permissions[$action]);
                         return parent::callAction($method, $parameters);
                     }
                 }
             }
         }

         if($free){
             return parent::callAction($method, $parameters);
         }

         session()->flash('http', [
             'type'     =>  'fail',
             'title'    => 'Unauthorized',
             'message'  => 'You dont have permission for this action.',
             'status'   => 401,
             'box'      => 'danger',
         ]);
         return redirect()->back();
     }
 }
