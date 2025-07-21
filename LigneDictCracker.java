public class LigneDictCracker implements CrackerFactory {
    public StrategieFactory createAttack() {
        return new DictionnaireStrategie();
    }
    public cibleFactory createTarget() {
        return new LigneCible();
    }
}
