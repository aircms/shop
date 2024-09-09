<?php

declare(strict_types=1);

namespace App\Module\Ui\Controller;

use Air\Core\Exception\ClassWasNotFound;
use Air\Model\Exception\CallUndefinedMethod;
use Air\Model\Exception\ConfigWasNotProvided;
use Air\Model\Exception\DriverClassDoesNotExists;
use Air\Model\Exception\DriverClassDoesNotExtendsFromDriverAbstract;
use App\Model\Article;
use App\Model\ArticleCategory;
use App\Model\ArticleTag;
use App\Model\BlogSettings;
use Exception;

class Blog extends Base
{
  /**
   * @var int
   */
  public int $countPerPage = 13;

  /**
   * @param ArticleCategory|null $category
   * @param ArticleTag|null $tag
   * @param int|null $page
   * @return void
   * @throws ClassWasNotFound
   * @throws CallUndefinedMethod
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   */
  public function index(?ArticleCategory $category = null, ?ArticleTag $tag = null, ?int $page = 1): void
  {
    $cond = ['publishedAt' => ['$lte' => time()]];

    $this->getView()->setDefaultMeta(function () {
      return BlogSettings::one()->meta;
    });

    if ($category) {
      $cond['category'] = $category;
      $this->getView()->setMeta($category->meta);
    }

    if ($tag) {
      $cond['tags'] = $tag->id;
      $this->getView()->setMeta($tag->meta);
    }

    $articles = Article::all($cond, ['publishedAt' => -1], $this->countPerPage, ($page - 1) * $this->countPerPage);
    $count = Article::quantity($cond);

    $this->getView()->setVars([
      'articles' => $articles,
      'categories' => ArticleCategory::all(),
      'tags' => BlogSettings::one()->tags,

      'category' => $category,
      'tag' => $tag,

      'count' => $count,
      'page' => $page,
      'show' => $this->countPerPage
    ]);
  }

  /**
   * @param Article $article
   * @return void
   * @throws CallUndefinedMethod
   * @throws ClassWasNotFound
   * @throws ConfigWasNotProvided
   * @throws DriverClassDoesNotExists
   * @throws DriverClassDoesNotExtendsFromDriverAbstract
   * @throws Exception
   */
  public function article(Article $article): void
  {
    $this->getView()->setMeta($article->meta);

    $this->getView()->setVars([
      'article' => $article,
      'categories' => ArticleCategory::all(),
      'tags' => BlogSettings::one()->tags,
    ]);
  }
}