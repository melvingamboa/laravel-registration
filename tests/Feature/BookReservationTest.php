<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'  => "Cook Book Title",
            'Author' => "Sebastian"
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'  => "",
            'Author' => "Sebastian"
        ]);

        $response->assertSessionHasErrors('title');
    }

      /** @test */
      public function a_author_is_required()
      {
          // $this->withoutExceptionHandling();
  
          $response = $this->post('/books', [
              'title'  => "Cook Book Title",
              'Author' => ""
          ]);
  
          $response->assertSessionHasErrors('author');
      }
  

      /** @test */
      public function a_book_can_be_updated()
      {
        // $this->withoutExceptionHandling();
  
         $this->post('/books', [
              'title'  => "Cook Book Title",
              'author' => "Sebastian"
          ]);
            
          $book = Book::first();

          $response = $this->patch('/books/'. $book->id,[
              'title'  => "New Title",
              'author' => 'New Author'
          ]);

          $this->assertEquals('New Title', Book::first()->title);  
          $this->assertEquals('New Author', Book::first()->author);  
      }
  

}
