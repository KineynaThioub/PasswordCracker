public class LocalCible implements cibleFactory {

    private final String loginValide = "admin";
    private final String passwordValide = "pass123";

    @Override
    public boolean connexion(String login, String password) {
        return loginValide.equals(login) && passwordValide.equals(password);
    }
}
