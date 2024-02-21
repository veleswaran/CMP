<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            [
                'name'=>'CareGiver Create',
                "permission_group_id"=> PermissionGroup::where('name','CareGiver')->first()->id
            ],
            [
                'name'=>'CareGiver List',
                "permission_group_id"=> PermissionGroup::where('name','CareGiver')->first()->id
            ],
            [
                'name'=>'CareGiver Edit',
                "permission_group_id"=> PermissionGroup::where('name','CareGiver')->first()->id
            ],
            [
                'name'=>'CareGiver Delete',
                "permission_group_id"=> PermissionGroup::where('name','CareGiver')->first()->id
            ],
            [
                'name'=>'CareSeeker Create',
                "permission_group_id"=> PermissionGroup::where('name','CareSeeker')->first()->id
            ],
            [
                'name'=>'CareSeeker List',
                "permission_group_id"=> PermissionGroup::where('name','CareSeeker')->first()->id
            ],
            [
                'name'=>'CareSeeker Edit',
                "permission_group_id"=> PermissionGroup::where('name','CareSeeker')->first()->id
            ],
            [
                'name'=>'CareSeeker Delete',
                "permission_group_id"=> PermissionGroup::where('name','CareSeeker')->first()->id
            ]
        ];
        foreach($permissions as $key=>$value){
            $permission =new Permission();
            $permission->name = $value['name'];
            $permission->permission_group_id =$value['permission_group_id'];
            $permission->save();
        }
    }
}
