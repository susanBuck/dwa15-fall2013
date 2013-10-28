p2.webdevdojo.biz
=================

This project is a simple microblog where users can post short status updates and follow the status updates of friends.
I.e. a super scaled down Twitter. The project shall be created using PHP with a custom micro-framework.

Users to your microblog can...

    Sign up
    Log in
    Log out
    Add posts
    See a list of all other users
    Follow and unfollow other users
    View a stream of posts from the users they follow
    +1 other feature of your choosing
    +1 other feature of your choosing
    On your main landing page, clearly state what your two +1 features are.

In addition to these set requirements, the project handles all the logistical pieces of this application.

For example, non-logged in users shouldn't see user-only areas, the site shall need a navigation menu, landing page, etc.

+1 feature ideas

Features can be one of the following, or something else along these lines.

    Delete a post
    Edit a post
    Upload a profile photo
    Edit and display basic profile info (location, bio, etc.)
    Reset password feature
    Email confirmation upon sign-up
    Email verification (requires users to click a link in their email before their account is created)
    "Like" feature
    "Send to a friend" feature where posts can be emailed to friends

Rubric
Meets base requirements

    Essentials: See Requirements 1-7
    Two additional features of your choosing: See Requirements 8-10

Logistics

    Your project should exist at p2.yourdomain.com
    Your project should be fully version controlled
    Your project should use the class PHP framework

Code

    Well organized, well commented.
    PHP: Bad / Improved
    HTML: Bad / Improved
    CSS: Bad / Improved

    There are no set standards (ex docblocks, indent styles, tabs vs. spaces, etc.) for code organization and comments. The only requirement is that it is neat, readable, consistent and syntactically correct (e.g. no missing closing tags).
    Paragraph wrapping is okay.
    It's okay if your code does not look neat when viewed through the "View Source" feature of your browser; we'll be checking your code using the Github Viewer. That being said, even the Github Viewer sometimes messes with formatting. The best way to prevent this is make sure you're consistently using tabs or spaces to indent code, not a mixture of both. See this graphic for more information.
    If the code does look messy in Github Viewer, and there's any question on our end about whether the code itself is messy or it's just rendering messy, we'll copy the code over to our code editors to test.
    Source Code Comment Styling: Tips And Best Practices

    Follows DRY principle as discussed in lecture.
    Separation of display and logic as discussed in lecture.
    There should be little to no HTML/CSS in your controllers or libraries. There should only be display-specific PHP in your views.
    Valid HTML5
    Your code should pass HTML validation.

Application

    Free of bugs
    Examples: There should be no dead links. Every button should work. No broken images. Log in/Sign up/Log out works as expected, etc.

    Uses error handling
    Examples: Don't let your user submit blank fields or use the same email twice to sign up. Like any real life application, you are in charge of finding all the possible places a user might enter unexpected data that might break your system. In addition to your own thorough tests, have a friend sit and use your application; this is often the quickest way to identify issues you didn't think of.

    Cross-browser compatible: IE9+ and latest versions of Chrome and Firefox
    Works without bugs on all of these browsers. The design does not have to look exactly the same on each browser, it just has to look good / not-broken. For example, if a menu appears in a slightly different location on IE, that's okay. But if a menu is truncated so the last link is not visible in IE, that is not okay.
    Flow makes sense (i.e. don't confuse the user)
    Examples: If I make a new post, it should give me some sort of confirmation. If I log out, it shouldn't let me see my profile.

Interface implementation

This is not a web design course, but as responsible web authors we should be aiming for thoughtfully designed and accessible web sites.

    Adequate text-to-background contrast (see chart)
    Easy-to-read font size
    16px and higher. You don't have to set it as px - you can use ems, rems, etc., it just has to calculate to be at least 16px.
    Clear visual hierarchy (See point #1)
    Consistent styles and colors

Accessibility / Usability

    Reasonable site load time (no more than 3 seconds)
    Alt tags for non-decorative images
    Main navigation easily identifiable
    Some sort of main heading or logo which links to home page
    Consistent and easy-to-identify links
    Critical content above the fold

Frequently Asked Questions
Do I have to use PHP? What if I want to use [insert other programming language here]?

Asking this is kind of like taking a Spanish class and asking to turn in a French term paper, but, that being said, if you wish to complete the project requirements with another language you're welcome to do so at your own risk.
Do I have to use the class framework? What if I want to use [insert other framework name here]?

If you're new to server side programming, it's suggested you use the framework we're covering in class.
If you choose to use another framework (CakePHP, CodeIgniter, etc.), you do so at your own risk.

You can not use a CMS such as WordPress, Drupal, Joomla.

