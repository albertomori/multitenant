ipunkt/multitenant
==================

The goal of this package is to make it easy to make your application multi-tenant aware with little to no code changes to
your actual application.

# Concept

- A user is member of one or more tenants.
- after logging into a user with more than one tenant the user will be asked to choose the tenant he wants to use.
- For each tenant he logs into the app will behave like the data belonging to this tenant is the only data in existence.
- This process is hidden from the application and happens purely in the package.

# Implementation

- Deciding which Tenant the User wants to use will be done through a filter. This filter should be used for every route
    a logged in User accesses.
- Seperating data is done through setting up 2 different Database connections.  
    - The first connection is untouched and is meant to access the User table and other Data which does not belong to a specific tenant.
    - The second connection will transform based on the chosen tenant.  
        The default transformation is adding a tenant-specific string to the table prefix  
        This connection will only receive tenant-specific data. It is recommended to make this the default connection.
