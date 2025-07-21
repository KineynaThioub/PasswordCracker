public class BruteForceStrategie implements StrategieFactory {
    private final String caracteres = "abcdefghijklmnopqrstuvwxyzQWERTYUIOPASDFGHJKLZXCVBNM1234567890_?/.@#^-+=`";
    private boolean found = false;

  
    public void attaque(String login, cibleFactory cible) {
        for (int length = 1; length <= 10; length++) {
            teste("", length, login, cible);
            if (found) break;
        }
    }

    private void teste(String prefix, int length, String login, cibleFactory cible) {
        if (found) return;

        if (prefix.length() == length) {
            if (cible.connexion(login, prefix)) {
                System.out.println("Mot de passe trouvé : " + prefix);
                found = true;
            }
            return;
        }

        for (int i = 0; i < caracteres.length(); i++) {
            teste(prefix + caracteres.charAt(i), length, login, cible);
            
            if (found) break;
        }
    }

}
