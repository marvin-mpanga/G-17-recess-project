package SERVER;

import org.fusesource.jansi.Ansi;
import org.fusesource.jansi.AnsiConsole;

import java.io.PrintWriter;

public class WelcomeMessage {
    public static void displayWelcomeMessage(PrintWriter writer) {
        AnsiConsole.systemInstall();

        String welcomeMessage =
                Ansi.ansi().eraseScreen().cursor(1, 1).toString() +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("╔════════════════════════════════════════════╗").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("║").fgBright(Ansi.Color.WHITE).bold().a("           The Math Challenge").boldOff().fgBright(Ansi.Color.BLUE).a("           ║").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("╠════════════════════════════════════════════╣").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("║").fgBright(Ansi.Color.YELLOW).a("  Test your mathematical prowess!").fgBright(Ansi.Color.BLUE).a("           ║").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("║").fgBright(Ansi.Color.YELLOW).a("  Compete with enthusiasts worldwide.").fgBright(Ansi.Color.BLUE).a("      ║").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("║").fgBright(Ansi.Color.YELLOW).a("  Solve puzzles, unlock achievements.").fgBright(Ansi.Color.BLUE).a("     ║").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("╠════════════════════════════════════════════╣").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("║").fgBright(Ansi.Color.GREEN).a("  Available commands:").fgBright(Ansi.Color.BLUE).a("                    ║").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("║").fgBright(Ansi.Color.WHITE).a("    login, viewchallenges, logout, exit").fgBright(Ansi.Color.BLUE).a("  ║").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.BLUE).a("╚════════════════════════════════════════════╝").toString() + "\n\n" +
                        Ansi.ansi().fgBright(Ansi.Color.MAGENTA).a("Are you ready to begin your mathematical journey?").toString() + "\n" +
                        Ansi.ansi().fgBright(Ansi.Color.MAGENTA).a("Type a command to get started!").toString() + "\n";

        writer.println(welcomeMessage);
        writer.flush();


    }
}
