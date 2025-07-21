import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class LigneCible implements cibleFactory {

    public boolean connexion(String login, String password) {
        try {
            URL url = new URL("http://monsite.com/api/login");
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            con.setRequestMethod("POST");
            con.setDoOutput(true);
            con.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");

            String body = "login=" + URLEncoder.encode(login, "UTF-8") +
                          "&password=" + URLEncoder.encode(password, "UTF-8");

            OutputStream os = con.getOutputStream();
            os.write(body.getBytes());
            os.flush();
            os.close();

            int status = con.getResponseCode();

            BufferedReader in = new BufferedReader(new InputStreamReader(
                status >= 200 && status < 300 ? con.getInputStream() : con.getErrorStream()
            ));

            StringBuilder response = new StringBuilder();
            String line;
            while ((line = in.readLine()) != null) {
                response.append(line);
            }
            in.close();

            String responseStr = response.toString().toLowerCase();
            return responseStr.contains("success") || responseStr.contains("connected");

        } catch (Exception e) {
            System.err.println("Erreur de connexion vers l'API : " + e.getMessage());
            return false;
        }
    }
}
