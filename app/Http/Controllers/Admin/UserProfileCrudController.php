<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserProfileRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserProfileCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserProfileCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\UserProfile::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/userprofile');
        CRUD::setEntityNameStrings('user profile', 'users profile');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([  
        'name'         => 'user', // name of relationship method in the model
        'type'         => 'relationship',
        'label'        => 'User', // Table column heading
        ]);
        CRUD::column('phone');
        CRUD::addColumn([  
        'name'         => 'country', // name of relationship method in the model
        'type'         => 'relationship',
        'label'        => 'Country', // Table column heading
        ]);
        CRUD::addColumn([  
        'name'         => 'city', // name of relationship method in the model
        'type'         => 'relationship',
        'label'        => 'City', // Table column heading
        ]);        
        CRUD::addColumn([
            'name'      => 'avatar', // The db column name
            'label'     => 'User avatar', // Table column heading
            'type'      => 'image',
            'height' => '70px',
            'width'  => '70px',
        ]);
        CRUD::addColumn([  
        'name'         => 'bodyShape', // name of relationship method in the model
        'type'         => 'relationship',
        'label'        => 'Body Shape', // Table column heading
        ]);
        CRUD::addColumn([  
        'name'         => 'skinGlow', // name of relationship method in the model
        'type'         => 'relationship',
        'label'        => 'Skin Glow', // Table column heading
        ]);
        CRUD::addColumn([  
        'name'         => 'job_id', // name of relationship method in the model
        'type'         => 'table',
        'label'        => 'Job', // Table column heading
        'columns'      => [
                'id' => '#',
                'title'  => 'Title',
            ]
        ]);
        CRUD::addColumn([  
        'name'         => 'goal_id', // name of relationship method in the model
        'type'         => 'table',
        'label'        => 'Goal', // Table column heading
        'columns'      => [
                'id' => '#',
                'title'  => 'Title',
            ]
        ]);
        CRUD::addColumn([  
        'name'         => 'favourite_style_id', // name of relationship method in the model
        'type'         => 'table',
        'label'        => 'Favourite Style', // Table column heading,
        'columns'      => [
                'id' => '#',
                'title'  => 'Title',
            ]
        ]);
        CRUD::column('created_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserProfileRequest::class);
        CRUD::field('user_id');
        CRUD::addField([
            'name' => 'avatar',
            'type' => 'image',
            'upload' => true,
            'disk' => 'public',
            'aspect_ratio' => 1
        ]);
        CRUD::field('phone');
        CRUD::field('Country');
        CRUD::field('City');
        CRUD::field('bodyShape');
        CRUD::field('favouriteStyle');
        CRUD::field('goal');
        CRUD::field('job');
        CRUD::field('skinGlow');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
