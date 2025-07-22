public class LigneBruteCracker implements CrackerFactory {
    public StrategieFactory createAttack() {
        return new BruteForceStrategie();
    }
    public cibleFactory createTarget() {
        return new LigneCible();
    }
}
