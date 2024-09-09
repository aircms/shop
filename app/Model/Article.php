<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\File;
use Air\Type\Meta;
use Air\Type\RichContent;

/**
 * @collection Article
 *
 * @property string $id
 *
 * @property string $url
 * @property string $title
 * @property string $description
 * @property File $image
 *
 * @property ArticleCategory $category
 * @property ArticleTag[] $tags
 * @property Article[] $articles
 *
 * @property boolean $enabled
 * @property integer $publishedAt
 *
 * @property RichContent[] $richContent
 *
 * @property Meta $meta
 *
 * @property Language $language
 *
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class Article extends ModelAbstract
{
}