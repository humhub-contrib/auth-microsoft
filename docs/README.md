# Microsoft Azure AD (Azure Active Directory) Sign-In

Using this module, users can directly log in or register with their Microsoft account credentials at this HumHub installation. 
A new button "Microsoft" will appear on the login page.

## Configuration

Please follow the [Microsoft instructions](https://docs.microsoft.com/en-us/azure/active-directory/develop/active-directory-v2-protocols#app-registration) to create the required ` OAuth ` credentials.

Once you have the **Directory(Tenant) ID**, **Client ID** and **Client Secret** created there, the values must then be entered in the module configuration at: `Administration -> Modules -> Microsoft Auth -> Settings`.
Add a Redirect URI, which you can find on the module configuration page, to your registered Azure application.