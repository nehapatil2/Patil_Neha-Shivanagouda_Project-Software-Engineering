class UserTest extends \PHPUnit\Framework\TestCase {
  public function testUserRegistration() {
    $user = new User();
    $result = $user->register("testuser", "testemail@example.com", "password123");
        // Assert that the user registration returns true
    $this->assertTrue($result);
  }
}
