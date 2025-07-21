public class LigneCible implements cibleFactory {
    private final String login = "admin";
    private final String password = "passer1234";

    public boolean authenticate(String login, String password) {
        return this.login.equals(login) && this.password.equals(password);
    }
}