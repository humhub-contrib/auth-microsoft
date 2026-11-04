# Microsoft Sign-In

Using this module, users can directly log in or register with their Microsoft account credentials at this HumHub installation. 
A new button "Microsoft" will appear on the login page.

## Configuration

Please follow the [Microsoft instructions](https://docs.microsoft.com/en-us/azure/active-directory/develop/active-directory-v2-protocols#app-registration) to create the required ` OAuth ` credentials.

Once you have the **Client ID** and **Client Secret** created there, the values must then be entered in the module configuration at: `Administration -> Modules -> Microsoft Auth -> Settings`.
Add a Redirect URI, which you can find on the module configuration page, to your registered Azure application.

Optionally, enter the **Tenant ID** (directory ID or domain of your organization) to restrict sign-in to the users of this organization. If it is empty, accounts of any organization and personal Microsoft accounts can sign in.

**Note:** Once a Tenant ID is set, users who do not belong to this organization (including personal Microsoft accounts) can no longer sign in with Microsoft, even if they have signed in this way before. They can still use their password, and clearing the Tenant ID restores the previous behavior.
