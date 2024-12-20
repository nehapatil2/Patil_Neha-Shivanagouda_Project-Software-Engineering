class UserTest extends \PHPUnit\Framework\TestCase {
  public function testUserLoginValid() {
    $user = new User();
    $result = $user->login("testuser", "password123");
    // Assert that the login returns true
    $this->assertTrue($result);
  }
}
