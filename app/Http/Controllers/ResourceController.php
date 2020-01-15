<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
class ResourceController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index() {
    //     $article_first = Post::where('status', 'PUBLISHED')->where('type', 'articles')->orderBy('id', 'DESC')->first();
    //     $article_next = Post::where('status', 'PUBLISHED')->where('type', 'articles')->where('id', '<', $article_first->id)->orderBy('id', 'DESC')->first();
    //     $caseStudy_first = Post::where('status', 'PUBLISHED')->where('type', 'caseStudy')->orderBy('id', 'DESC')->first();
    //     $caseStudy_next = Post::where('status', 'PUBLISHED')->where('type', 'caseStudy')->where('id', '<', $caseStudy_first->id)->orderBy('id', 'DESC')->first();
    //     return view('resources.index', compact('article_first', 'article_next', 'caseStudy_first', 'caseStudy_next'));
    // }
    public function index(Request $request)
    {
      $posts = Post::paginate(5);
      return view('resources.index',compact('posts'));
    }
    public function articles() {
        $articles = Post::where('category_id', '1')->orderBy('id', 'DESC')->get();
         /**
          * meta keywords
          */
        return view('resources.articles', compact('articles'));
    }
    public function caseStudy() {
        $caseStudies = Post::where('category_id', '2')->orderBy('id', 'DESC')->get();
        return view('resources.case-studies', compact('caseStudies'));
    }
    public function articlesDetail(Post $post) {
        $articles = Post::where('category_id', '1')->where('id','!=',$post->id)->orderby('id', 'DESC')->limit(4)->get();
        return view('resources.article-detail', compact('post', 'articles'));
    }
    public function caseStudyDetail(Post $post) {
        $caseStudies = Post::where('category_id', '2')->where('id','!=',$post->id)->orderby('id', 'DESC')->limit(4)->get();
        return view('resources.case-study-detail', compact('post', 'caseStudies'));
    }
}
