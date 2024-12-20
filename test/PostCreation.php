class PostTest extends \PHPUnit\Framework\TestCase {
  public function testPostCreation() {
    $post = new Post();
    $result = $post->create("Test Post", "This is a test post content.", "category", "tag");
    // Assert that the post creation returns true
    $this->assertTrue($result);
  }
}
