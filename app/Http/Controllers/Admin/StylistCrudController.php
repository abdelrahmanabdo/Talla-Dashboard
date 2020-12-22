<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StylistRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StylistCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StylistCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Stylist::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/stylist');
        CRUD::setEntityNameStrings('stylist', 'stylists');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('user');
        CRUD::addColumn([
            'name'      => 'avatar', // The db column name
            'label'     => 'Avatar', // Table column heading
            'type'      => 'image',
            'height' => '70px',
            'width'  => '70px',
        ]);
        CRUD::column('email');
        CRUD::column('country');
        CRUD::addColumn([  
        'name'         => 'mobile_numbers', // name of relationship method in the model
        'type'         => 'table',
        'label'        => 'Mobile Numbers', // Table column heading,
        'columns'      => [
                'mobile_numbers'  => 'Mobile',
            ]   
        ]);
        CRUD::column('bio');
        CRUD::column('experience_years');
        CRUD::addColumn([
            'name'  => 'is_approved',
            'label' => 'Is Approved ?',
            'type'  => 'boolean',
        ]);
        // CRUD::column('softDeletes');
        // CRUD::column('updated_at');
        CRUD::addColumn([
            'name'  => 'active',
            'label' => 'Is Active ?',
            'type'  => 'boolean',
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
        CRUD::setValidation(StylistRequest::class);
        CRUD::field('user_id');
        CRUD::field('email');
        CRUD::addField([
            'name' => 'avatar',
            'type' => 'image',
            'upload' => true,
            'disk' => 'public',
            'aspect_ratio' => 1
        ]);
        CRUD::addField([
            'name' => 'mobile_numbers',
            'type' => 'table',
            'columns'  => [
                'mobile_numbers'  => 'Mobile',
            ]  
        ]);
        CRUD::field('bio');
        CRUD::field('country_id');
        CRUD::field('experience_years');
        CRUD::addField([
            'name' => 'is_approved',
            'type' => 'radio',
            'label' => 'is account approved ?' ,
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                1 => "Yes",
                0 => "No"
            ],
        ]);
        // CRUD::field('softDeletes');
        CRUD::addField([
            'name' => 'active',
            'type' => 'radio',
            'label' => 'is account active ?' ,
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                1 => "Yes",
                0 => "No"
            ],
        ]);

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
