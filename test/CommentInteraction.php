class CommentTest extends \PHPUnit\Framework\TestCase {
  public function testFacebookCommentsLoaded() {
    $post = new Post();
    $result = $post->renderCommentsSection();
    // Assert that the comments section contains the Facebook widget code
    $this->assertStringContainsString('<div class="fb-comments"', $result);
  }
}
