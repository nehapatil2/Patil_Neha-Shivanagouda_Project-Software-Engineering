class PostTest extends \PHPUnit\Framework\TestCase {
  public function testPostDelete() {
    $post = new Post();
    $result = $post->delete(1);
    // Assert that the post deletion returns true
    $this->assertTrue($result);
  }
}
