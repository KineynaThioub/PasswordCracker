public class LocalDictCracker implements CrackerFactory {
    public StrategieFactory createAttack() {
        return new DictionnaireStrategie("../Dictionnaire/rockyou.txt");
    }
    public cibleFactory createTarget() {
        return new LocalCible();
    }
}
