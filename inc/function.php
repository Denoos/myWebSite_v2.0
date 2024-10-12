<?php
declare(strict_types=1);
function dd($some){
    echo '<pre>';
    print_r($some);
    echo '</pre>';
}
function goUrl(string $url){
    echo '<script type="text/javascript">location="';
    echo $url;
    echo '";</script>';
}
function getArticles() : array
{
    return json_decode(file_get_contents('../db/articles.json'), true);
}
function getArticleById(int $id):array
{
    $articleList =getArticles();
    $curentArticle = [];
    if (array_key_exists($id, $articleList)) {
        $curentLrticle = $articleList[$id];
    }
    return $curentArticle;
}
function getArticleLists(): string
{
    $articles = getArticles();
    $link = '';
    foreach ($articles as $article) {
        $link .= getOneArticle($article, true);
    }
    return $link;
}
function getOneArticle($article, $isList): string
{
    $link = '';
    if (empty($isList)) {
        $link = '
<p>
    Ups, bóbr nie jest już kurwą, bo biegle nie mówi po polsku <br>
    (ссылка на стим преподавателя: https://steamcommunity.com/id/cahadi/) <br>
    (Я не розумію навіщо потрібен цей блок коду) <br>
</p>';
    }

    # Universal structure of card creating
    $link .= '
    <article class="col-12 col-md-6 tm-post">
    <hr class="tm-hr-primary">
        <div class="tm-post-link-inner">
            <img src="' . $article['image'] . '" alt="Image" class="img-fluid">
        </div>
        <span class="position-absolute tm-new-badge"> New(' . $article['id'] . ')</span>
        <h2 class="tm-pt-30 tm-color-primary tm-post-title">' . $article['title'] . '</h2>';

    if ($isList == false)
    {
        $link .= '
        <p class="tm-pt-30">
            ' . $article['content'] . '
        </p>';
    }

    $link .= '<hr>
    <div class="d-flex justify-content-between tm-pt-45">';

    if ($isList) {
        $link = '
        <span class="tm-color-gray"><a href="index.php?id=' . $article['id'] . '" class="btn center-block">More Info</a></span>';
    }
    else {
        $link = '
        <span class="tm-color-gray"><a href="index.php" class="btn center-block">All states</a></span>
        <span class="tm-color-gray"><a class="btn center-block">Edit</a></span>
        <span class="tm-color-gray"><a class="btn center-block">Delete</a></span>';
    }

    $link .= '
</div>
</article>';
    return $link;
}
function main():string
{
    if (isset($_GET['id']))
    {
        $id = (int)$_GET['id'];
        dd($id);
        $article = getArticleById($id);
        return getOneArticle($article, false);
    }
    else
    {
        return getArticleLists();
    }
}