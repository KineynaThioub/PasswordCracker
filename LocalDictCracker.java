public class LocalDictCracker implements CrackerFactory {
    public StrategieFactory createAttack() {
        return new DictionnaireStrategie("rockyou.txt");
    }
    public cibleFactory createTarget() {
        return new LocalCible();
    }
}
