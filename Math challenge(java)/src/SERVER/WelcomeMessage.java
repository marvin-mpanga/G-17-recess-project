package SERVER;

import org.fusesource.jansi.Ansi;
import org.fusesource.jansi.AnsiConsole;

import java.io.PrintWriter;

public class WelcomeMessage {

    private static final Ansi.Color BLUE = Ansi.Color.BLUE;
    private static final Ansi.Color WHITE = Ansi.Color.WHITE;
    private static final Ansi.Color YELLOW = Ansi.Color.YELLOW;
    private static final Ansi.Color GREEN = Ansi.Color.GREEN;
    private static final Ansi.Color MAGENTA = Ansi.Color.MAGENTA;

    private static final String BORDER_TOP = Ansi.ansi().fgBright(BLUE).a("╔════════════════════════════════════════════╗").toString();
    private static final String BORDER_MID = Ansi.ansi().fgBright(BLUE).a("╠════════════════════════════════════════════╣").toString();
    private static final String BORDER_BOTTOM = Ansi.ansi().fgBright(BLUE).a("╚════════════════════════════════════════════╝").toString();

    private static final String TITLE = Ansi.ansi().fgBright(BLUE).a("║").fgBright(WHITE).bold().a("           The Math Challenge").boldOff().fgBright(BLUE).a("                                     ║").toString();
    private static final String LINE1 = Ansi.ansi().fgBright(BLUE).a("║").fgBright(YELLOW).a("  Test your mathematical prowess!").fgBright(BLUE).a("                                                 ║").toString();
    private static final String LINE2 = Ansi.ansi().fgBright(BLUE).a("║").fgBright(YELLOW).a("  Compete with enthusiasts worldwide.").fgBright(BLUE).a("                                             ║").toString();
    private static final String LINE3 = Ansi.ansi().fgBright(BLUE).a("║").fgBright(YELLOW).a("  Solve puzzles, unlock achievements.").fgBright(BLUE).a("                                             ║").toString();
    private static final String COMMANDS_HEADER = Ansi.ansi().fgBright(BLUE).a("║").fgBright(GREEN).a("  Available commands:").fgBright(BLUE).a("                                                              ║").toString();
    private static final String COMMANDS_LIST = Ansi.ansi().fgBright(BLUE).a("║").fgBright(WHITE).a("    register, loginParticipant, loginRepresentative, viewApplicants, viewChallenges, logoutParticipant,logoutRepresentative, exitParticipant").fgBright(BLUE).a("  ║").toString();
    private static final String PROMPT1 = Ansi.ansi().fgBright(MAGENTA).a("Are you ready to begin your mathematical journey?").toString();
    private static final String PROMPT2 = Ansi.ansi().fgBright(MAGENTA).a("Type a command to get started!").toString();

    public static void displayWelcomeMessage(PrintWriter writer) {
        AnsiConsole.systemInstall();

        String welcomeMessage = Ansi.ansi().eraseScreen().cursor(1, 1).toString() +
                BORDER_TOP + "\n" +
                TITLE + "\n" +
                BORDER_MID + "\n" +
                LINE1 + "\n" +
                LINE2 + "\n" +
                LINE3 + "\n" +
                BORDER_MID + "\n" +
                COMMANDS_HEADER + "\n" +
                COMMANDS_LIST + "\n" +
                BORDER_BOTTOM + "\n\n" +
                PROMPT1 + "\n" +
                PROMPT2 + "\n";

        writer.println(welcomeMessage);
        writer.flush();
    }
}
