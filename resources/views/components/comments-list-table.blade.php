@props(['dataProvider'])


@gridView([
    'dataProvider' => $dataProvider,
    'paginatorOptions' => [
        'pageName' => __('Comments History')
    ],
    'rowsPerPage' => 5,
    'strictFilters' => true,
    'rowsFormAction' => route('comment.list'),
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
    'content'=>[
        'name'=> 'content',
        'label' => 'Content',
        'sort' => 'content',
        'attribute' => 'content',
        'htmlAttributes' => [
            'width' => '15%'
        ],
    ],
    'post'=>[
        'name'=> 'post',
        'filter' => false,
        'label' => 'Post',
        'htmlAttributes' => [
            'width' => '15%'
        ],
        'format' => [
            'class' => Itstructure\GridView\Formatters\UrlFormatter::class,
            'title' => $dataProvider->post,


            'htmlAttributes' => [
                'width' => '100',
                'href'=>'#'
            ]
        ],
    ],

{{--    ],--}}
{{--    'image' =>[--}}
{{--        'filter' => false,--}}
{{--        'name' =>'Image',--}}
{{--        'attribute' => 'image',--}}
{{--        'sort' => false,--}}
{{--        'htmlAttributes' => [--}}
{{--            'width' => '10%'--}}
{{--        ],--}}
{{--        'format' => [--}}
{{--            'class' => Itstructure\GridView\Formatters\ImageFormatter::class,--}}
{{--            'htmlAttributes' => [--}}
{{--                'width' => '100'--}}
{{--            ]--}}
{{--        ],--}}
{{--    ],--}}
{{--    'body'=>[--}}
{{--        'name'=> 'body',--}}
{{--        'label' => 'Body',--}}
{{--        'sort' => 'body',--}}
{{--        'attribute' => 'body',--}}
{{--        'htmlAttributes' => [--}}
{{--            'width' => '15%'--}}
{{--        ],--}}
{{--        'value' => function ($row) {--}}
{{--            return sprintf('%s ...',mb_substr($row->body, 0, 30));--}}
{{--        },--}}
{{--    ],--}}

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
{{--    [--}}
{{--        'class' => Itstructure\GridView\Columns\ActionColumn::class,--}}
{{--        'actionTypes' => [--}}
{{--            'view' => function($row){--}}
{{--                return route('post.user.show', ['id' => $row->id]);--}}
{{--            },--}}
{{--            'edit' => function ($row) {--}}
{{--                return route('posts.edit', ['id' => $row->id]);--}}
{{--            },--}}
{{--            [--}}
{{--                'class' => Itstructure\GridView\Actions\Delete::class,--}}
{{--                'url' => function ($row) {--}}
{{--                    return route('post_delete',['id'=> $row->id]) ;--}}
{{--                },--}}
{{--                'htmlAttributes' => [--}}
{{--                    'style' => 'color: yellow; font-size: 16px;',--}}
{{--                    'onclick' => 'return window.confirm("Sure to delete?");'--}}
{{--                ]--}}
{{--            ]--}}
{{--        ]--}}
{{--    ],--}}
]
])

