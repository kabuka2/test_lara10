
@gridView([
    'dataProvider' => $dataProvider,
    'paginatorOptions' => [
        'pageName' => 'post'
    ],
    'rowsPerPage' => 15,
    'strictFilters' => true,
    'rowsFormAction' => route('post_list'),
    'columnOptions' => [
        'class' => 'attribute',
        'sortable' => false,
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
            'name'=> 'name',
            'label' => 'Name',
            'sort' => 'name',
            'attribute' => 'name',
            'htmlAttributes' => [
                'width' => '15%'
            ],
        ],

{{--        'href'=>[--}}
{{--            'name'=> 'href',--}}
{{--            'label' => 'Href',--}}
{{--            'sort' => false,--}}
{{--            'attribute' => 'href',--}}
{{--            'htmlAttributes' => [--}}
{{--                'width' => '10%',--}}
{{--            ],--}}

{{--            'format' => [--}}
{{--            'class' => Itstructure\GridView\Formatters\UrlFormatter::class, // Set the UrlFormatter class--}}
{{--            'htmlAttributes' => [--}}
{{--            'width' => '100', // Set the width attribute for the link (optional)--}}
{{--            'name' => 'wefwewe', // This line seems to be incorrect. You can remove it as it doesn't have any effect.--}}
{{--            ],--}}
{{--            'url' => function ($row) {--}}
{{--            return route('post.user.show', ['id' => $row->id]); // Generate the URL using the 'post.user.show' route and the row data--}}
{{--            },--}}
{{--            ],--}}
{{--        ],--}}

        'image' =>[
            'filter' => false,
            'name' =>'Image',
            'attribute' => 'image',
            'sort' => false,
            'htmlAttributes' => [
                'width' => '10%'
            ],
            'format' => [
                'class' => Itstructure\GridView\Formatters\ImageFormatter::class,
                'htmlAttributes' => [
                    'width' => '100'
                ]
            ],
        ],

        'body'=>[
            'name'=> 'body',
            'label' => 'Body',
            'sort' => 'body',
            'attribute' => 'body',
            'htmlAttributes' => [
                'width' => '15%'
            ],
            'value' => function ($row) {
                return sprintf('%s ...',mb_substr($row->body, 0, 30));
            },
        ],
        'date_publish'=>[
            'name'=> 'date_publish',
            'label' => 'Date Publish',
            'sort' => 'date_publish',
            'attribute' => 'date_publish',
            'htmlAttributes' => [
                'width' => '15%'
            ],

        ],
{{--        'status'=>[--}}
{{--            'name'=> 'status',--}}
{{--            'label' => 'Status',--}}
{{--            'sort' => 'body',--}}
{{--            'attribute' => 'deleted_at',--}}
{{--            'htmlAttributes' => [--}}
{{--                'width' => '15%'--}}
{{--            ],--}}
{{--            'filter' => [--}}
{{--                'class' => Itstructure\GridView\Filters\DropdownFilter::class,--}}
{{--                'name' => 'status',--}}
{{--                'data' => ['1' => 'active', '0' => 'inactive']--}}
{{--            ],--}}
{{--            'value' => function ($row) {--}}
{{--                return $row->status == 1 ? 'active': 'inactive';--}}
{{--            },--}}
{{--        ],--}}
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
        [
            'class' => Itstructure\GridView\Columns\ActionColumn::class,
            'actionTypes' => [
                'view' => function($row){
                    return route('post.user.show', ['id' => $row->id]);
                },
                'edit' => function ($row) {
                    return route('posts.edit', ['id' => $row->id]);
                },
                [
                    'class' => Itstructure\GridView\Actions\Delete::class,
                    'url' => function ($row) {
                        return route('post_delete',['id'=> $row->id]) ;
                    },
                    'htmlAttributes' => [

                        'style' => 'color: yellow; font-size: 16px;',
                        'onclick' => 'return window.confirm("Sure to delete?");'
                    ]
                ]
            ]
        ],
    ]
])
