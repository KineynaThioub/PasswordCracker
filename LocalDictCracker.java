public class LocalDictCracker implements CrackerFactory {
    public StrategieFactory createAttack() {
        return new DictionnaireStrategie();
    }
    public cibleFactory createTarget() {
        return new LocalCible();
    }
}
