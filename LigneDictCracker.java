public class LigneDictCracker implements CrackerFactory {
    public StrategieFactory createAttack() {
        return new DictionnaireStrategie("rockyou.txt");
    }
    public cibleFactory createTarget() {
        return new LigneCible();
    }
}
