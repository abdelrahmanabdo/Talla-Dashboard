<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BlogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
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
        CRUD::setModel(\App\Models\Blog::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blog');
        CRUD::setEntityNameStrings('blog', 'blogs');
    }

    /**
     * 
     */
    protected function setupShowOperation() {
        CRUD::addColumn([
          'label' => "User", 
          'type' => "select",
          'name' => 'user_id',
          'entity' => 'user', 
          'attribute' => "name", 
          'model' => "App\Models\User",
        ]);
        CRUD::column('title');
        CRUD::column('body');
        CRUD::addColumn([
          'label' => 'Hashtags',
          'type' => 'json',
          'name' => 'hashtags'
        ]); 
        CRUD::addColumn([
          'label' => "Images", 
          'type' => "relation",
          'name' => 'images',
          'entity' => 'images', 
          'attribute' => "image", 
          'model' => "App\Models\BlogImage",
          'upload'    => true,
          'disk'      => 'images',
        ]);
        CRUD::column('updated_at');
        CRUD::column('created_at');
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
          'label' => "User", 
          'type' => "select",
          'name' => 'user_id',
          'entity' => 'user', 
          'attribute' => "name", 
          'model' => "App\Models\User",
        ]);
        CRUD::column('title');
        CRUD::column('body');
        CRUD::addColumn([
          'label' => 'Hashtags',
          'type' => 'json',
          'name' => 'hashtags'
        ]); 
        CRUD::addColumn([
          'label' => "Images", 
          'type' => "relationship_count",
          'name' => 'images',
          'entity' => 'images', 
          'attribute' => "image", 
          'model' => "App\Models\BlogImage",
          'ajax'          => true,
          'inline_create' => true,
        ]);
        CRUD::column('updated_at');
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
        CRUD::addField([
          'label' => "User", 
          'type' => "select2",
          'name' => 'user_id',
          'entity' => 'user', 
          'attribute' => "name", 
          'model' => "App\Models\User",
        ]);
        CRUD::field('title');
        CRUD::addField([
          'label' => 'Body',
          'name' => 'body',
          'type' => 'easymde'
        ]);
        CRUD::addField([
          'label' => 'Tags',
          'name' => 'hashtags',
          'type' => 'text',
          'ajax' => true,
        ]); 
        CRUD::addField([
          'label' => "Images", 
          'type' => "upload_multiple",
          'name' => 'images',
          'entity' => 'images', 
          'attribute' => "image", 
          'model' => "App\Models\BlogImage",
          'upload'    => true,
          'disk'      => 'local',
        ]);
        CRUD::setValidation(BlogRequest::class);
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
