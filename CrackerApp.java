public class CrackerApp {
    public static void main(String[] args) {
        String type = null;
        String target = null;
        String login = null;

       
        for (int i = 0; i < args.length; i++) {
            switch (args[i]) {
                case "--type":
                    if (i + 1 < args.length) type = args[++i];
                    break;
                case "--target":
                    if (i + 1 < args.length) target = args[++i];
                    break;
                case "--login":
                    if (i + 1 < args.length) login = args[++i];
                    break;
            }
        }

        if (type == null || target == null || login == null) {
            System.out.println("❗ Utilisation : java CrackerApp --type <dictionnary|brute> --target <local|online> --login <nom>");
            return;
        }

       
        System.out.println("🔍 Type d'attaque : " + type);
        System.out.println("🎯 Cible : " + target);
        System.out.println("👤 Login cible : " + login);

       
        Attack attack = AttackFactory.create(type, target, login);

        if (attack == null) {
            System.out.println("❌ Erreur : combinaison type/target non supportée.");
            return;
        }

       
        attack.run();
    }
}
