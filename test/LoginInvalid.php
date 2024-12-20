class UserTest extends \PHPUnit\Framework\TestCase {
  public function testUserLoginInvalid() {
    $user = new User();
    $result = $user->login("testuser", "wrongpassword");
    // Assert that the login returns false
    $this->assertFalse($result);
  }
}
