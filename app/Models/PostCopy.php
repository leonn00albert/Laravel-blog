<?php
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class PostCopy
{

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    /**
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     * @param $slug
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }


    static function all()
    {
        return cache()->rememberForever("post.all",function(){
            return collect(File::files(resource_path("posts")))->map(fn($file) => YamlFrontMatter::parseFile($file))->map(
                fn($document) => new PostCopy(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug,
                )
            )->sortByDesc("date");
        });


    }
    static function find(string $slug)
    {

        return static::all()->firstWhere('slug',$slug);
    }

    static function findOrFail(string $slug)
    {

        $post = static::find($slug);

        if(! $post) {
            throw new ModelNotFoundException;
        }

        return $post;
    }

}
