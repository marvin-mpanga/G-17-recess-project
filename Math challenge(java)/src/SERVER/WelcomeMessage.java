package SERVER;

import org.fusesource.jansi.Ansi;
import org.fusesource.jansi.AnsiConsole;

import java.io.PrintWriter;

public class WelcomeMessage {

    private static final Ansi.Color BORDER = Ansi.Color.CYAN;
    private static final Ansi.Color TITLE = Ansi.Color.MAGENTA;
    private static final Ansi.Color HEADER = Ansi.Color.YELLOW;
    private static final Ansi.Color COMMAND = Ansi.Color.GREEN;
    private static final Ansi.Color DESCRIPTION = Ansi.Color.WHITE;
    private static final Ansi.Color PROMPT = Ansi.Color.BLUE;

    public static void displayWelcomeMessage(PrintWriter writer) {
        AnsiConsole.systemInstall();

        writer.println(colorize(BORDER, "╔═════════════════════════════════════════ ") +
                colorize(TITLE, "The Math Challenge") +
                colorize(BORDER, " ═════════════════════════════════════════╗"));
        writer.println(colorize(BORDER, "║                                                                                                    ║"));
        writer.println(colorize(BORDER, "║  ") +
                colorize(HEADER, "Welcome to the Math Challenge! Test your mathematical prowess and compete with enthusiasts worldwide.") +
                colorize(BORDER, " ║"));
        writer.println(colorize(BORDER, "║                                                                                                    ║"));
        writer.println(colorize(BORDER, "╠══════════════════════════════════════ ") +
                colorize(HEADER, "Available Commands") +
                colorize(BORDER, " ══════════════════════════════════════╣"));
        writer.println(colorize(BORDER, "║                                                                                                    ║"));
        writer.println(colorize(BORDER, "║  ") +
                colorize(HEADER, "For All Users:               For Participants:             For School Representatives:            ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║  ") +
                colorize(COMMAND, "• register                   ") +
                colorize(COMMAND, "• loginParticipant            ") +
                colorize(COMMAND, "• loginRepresentative                  ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║    ") +
                colorize(DESCRIPTION, "Create a new account         Log in as a participant       Log in as a school representative    ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                              ") +
                colorize(COMMAND, "• viewChallenges              ") +
                colorize(COMMAND, "• viewApplicants                       ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                                ") +
                colorize(DESCRIPTION, "See available challenges      View applicants for your school      ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                              ") +
                colorize(COMMAND, "• logoutParticipant           ") +
                colorize(COMMAND, "• logoutRepresentative                ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                                ") +
                colorize(DESCRIPTION, "Log out (for participants)    Log out (for representatives)         ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                              ") +
                colorize(COMMAND, "• exitParticipant                                                     ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                                ") +
                colorize(DESCRIPTION, "Exit the program                                                     ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                                                                                                    ║"));
        writer.println(colorize(BORDER, "╠════════════════════════════════════════════════════════════════════════════════════════════════════╣"));
        writer.println(colorize(BORDER, "║                                                                                                    ║"));
        writer.println(colorize(BORDER, "║  ") +
                colorize(PROMPT, "Are you ready to begin your mathematical journey? Type a command to get started!                  ") +
                colorize(BORDER, "║"));
        writer.println(colorize(BORDER, "║                                                                                                    ║"));
        writer.println(colorize(BORDER, "╚════════════════════════════════════════════════════════════════════════════════════════════════════╝"));

        writer.flush();
        AnsiConsole.systemUninstall();
    }

    private static String colorize(Ansi.Color color, String text) {
        return Ansi.ansi().fgBright(color).a(text).reset().toString();
    }
}