import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

public class DictionnaireStrategie implements StrategieFactory {

    private String cheminFichier="rockyou.txt";

    
    public DictionnaireStrategie(String cheminFichier) {
        if (cheminFichier == null || cheminFichier.trim().isEmpty()) {
            throw new IllegalArgumentException("Le chemin du fichier ne peut etre vide.");
        }
        this.cheminFichier = cheminFichier;
    }

    @Override
    public void attaque(String login, cibleFactory cible) {
        try (BufferedReader reader = new BufferedReader(new FileReader(cheminFichier))) {
            String motDePasse;
         

            while ((motDePasse = reader.readLine()) != null) {
                motDePasse = motDePasse.trim();
                if (motDePasse.isEmpty()) continue; 

                


                if (cible.connexion(login, motDePasse)) {
                    System.out.println("Mot de passe trouve: "  + motDePasse);
                    return;
                }
            }

            System.out.println("Mot de passe non trouve dans le dictionnaire ");

        } catch (IOException e) {
            System.err.println("Erreur lors de la lecture du fichier '" + cheminFichier + "' : " + e.getMessage());
            e.printStackTrace();
        }
    }
}