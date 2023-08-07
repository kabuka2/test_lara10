
@props(['dataProvider'])


@gridView([
    'dataProvider' => $dataProvider,
    'paginatorOptions' => [
        'pageName' => 'comments'
    ],
    'rowsPerPage' => 10,
    'strictFilters' => true,
    'rowsFormAction' => route('post_list'),
    'columnOptions' => [
    'class' => 'attribute',
        'sortable' => false,
    ],
    'columnFields' => [
        'content'=>[
            'name'=> 'content',
            'label' => 'Content',
            'sort' => 'content',
            'attribute' => 'content',
            'htmlAttributes' => [
                'width' => '40%'
            ],
        ],

        'created_at'=> [
            'filter' => false,
            'name' =>'Created',
            'attribute' => 'created_at',
            'sort' => 'created_at',
            'htmlAttributes' => [
                'width' => '15%'
            ],
        ],
        'updated_at'=> [
            'filter' => false,
            'name' =>'Created',
            'attribute' => 'updated_at',
            'filter' => false,
            'sort' => 'updated_at',
            'htmlAttributes' => [
                'width' => '15%'
            ],
        ],
        [
            'class' => Itstructure\GridView\Columns\ActionColumn::class,
            'actionTypes' => [
                'view' => function($row){
                    return route('post.user.show',[
                            'id'=> $row->post_id,
                            'comment'=> urlencode(md5($row->id.$row->user_id))
                    ]);

                },
                'edit' => function ($row) {
                    return route('comments.edit', ['id' => $row->id]);
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

