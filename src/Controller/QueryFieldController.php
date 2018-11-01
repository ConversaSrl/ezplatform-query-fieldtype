<?php
namespace BD\EzPlatformQueryFieldType\Controller;

use BD\EzPlatformQueryFieldType\GraphQL\QueryFieldResolver;
use eZ\Publish\Core\MVC\Symfony\View\ContentView;

class QueryFieldController
{
    /**
     * @var \BD\EzPlatformQueryFieldType\GraphQL\QueryFieldResolver
     */
    private $queryFieldResolver;

    public function __construct(QueryFieldResolver $queryFieldResolver)
    {
        $this->queryFieldResolver = $queryFieldResolver;
    }

    public function renderQueryFieldAction(ContentView $view, $queryFieldDefinitionIdentifier)
    {
        $queryResults = $this->queryFieldResolver->resolveQueryField(
            $view->getContent()->getField($queryFieldDefinitionIdentifier),
            $view->getContent()
        );

        $view->addParameters(['query_results' => $queryResults]);

        return $view;
    }
}