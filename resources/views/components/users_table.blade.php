@gridView([
    'dataProvider' => $dataProvider,
    'paginatorOptions' => [
        'pageName' => 'p'
    ],
    'rowsPerPage' => 5,
    'strictFilters' => false,
    'rowsFormAction' => route('users'),
    'columnOptions' => [
        'class' => 'attribute',
        'sortable' => true,
    ],
    'columnFields' => [
        'id' => [
            'name'=> 'id',
            'label' => 'ID',
            'sort' => 'id',
            'attribute' => 'id',
            'htmlAttributes' => [
                'width' => '5%'
            ],
        ],
        'email'=>[
            'name'=> 'email',
            'label' => 'Email',
            'sort' => 'email',
            'attribute' => 'email',
            'htmlAttributes' => [
                'width' => '25%'
            ],
        ],
        'name'=>[
            'name'=> 'name',
            'label' => 'Name',
            'sort' => 'name',
            'attribute' => 'name',
            'htmlAttributes' => [
                'width' => '15%'
            ],
        ],
        'email_verified_at' =>[
            'filter' => false,
            'name' =>'Created',
            'attribute' => 'email_verified_at',
            'sort' => 'email_verified_at',
            'htmlAttributes' => [
                'width' => '10%'
            ],
        ],
        'created_at'=> [
            'filter' => false,
            'name' =>'Created',
            'attribute' => 'created_at',
            'sort' => 'created_at',
            'htmlAttributes' => [
                'width' => '10%'
            ],
        ],
        'updated_at'=> [
            'filter' => false,
            'name' =>'Created',
            'attribute' => 'updated_at',
            'filter' => false,
            'sort' => 'updated_at',
            'htmlAttributes' => [
                'width' => '10%'
            ],
        ],
        [ // Set Action Buttons.
            'class' => Itstructure\GridView\Columns\ActionColumn::class, // REQUIRED.
            'actionTypes' => [
                'edit' => function ($data) {
                    return route('profile.edit_user', ['id' => $data->id]);
                },
                [
                    'class' => Itstructure\GridView\Actions\Delete::class, // REQUIRED
                    'url' => function ($data) {
                        return '/admin/pages/' . $data->id . '/delete';
                    },
                    'htmlAttributes' => [
                        'target' => '_blank',
                        'style' => 'color: yellow; font-size: 16px;',
                        'onclick' => 'return window.confirm("Sure to delete?");'
                    ]
                ]
            ]
        ],
    ]
])
