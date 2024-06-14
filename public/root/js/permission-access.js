
var userPermissions = ['love', 'sickness', 'Developer-Option'];

function hasPermission(permission) {
    return userPermissions.includes(permission);
}


function toggleElementBasedOnPermission(parentId, innerPermissions) {
    const parentElement = document.getElementById(parentId);

    if (parentElement) {
        const hasFullPermission = hasPermission('Developer-Option');
        const parentVisible = hasFullPermission || innerPermissions.some(permission => hasPermission(permission));
        // Show parent element
        parentElement.style.display = parentVisible ? 'block' : 'none';
        // Show specific inner li elements
        innerPermissions.forEach(innerPermission => {
            const innerElement = document.getElementById(innerPermission);
            if (innerElement) {
                // Show inner element if user has 'Developer-Option' or the specific inner permission
                innerElement.style.display = hasFullPermission || hasPermission(innerPermission) ? 'block' : 'none';
            }
        });
    }
}



// Define sections and their inner permissions
const sections = [

    {
        parentId: 'Full-Settings', innerPermissions:
        ['view-roles', 'add-role', 'modify-role', 'remove-role', 'view-permissions', 'add-permission', 'modify-permission', 'remove-permission', 'view-regions', 'add-region', 'modify-region', 'remove-region', 'view-districts', 'add-district', 'modify-district', 'remove-district', 'view-towns', 'add-town', 'modify-town', 'remove-town', 'view-identities', 'add-identity', 'modify-identity', 'remove-identity', 'view-notifications', 'add-notification', 'modify-notification', 'remove-notification']
    },


    {   parentId: 'Full-Users', innerPermissions:
        ['view-user', 'add-user', 'modify-user', 'remove-user', 'block-user', 'unblock-user', 'suspended-users', 'reset-password', 'verify-user', 'assign-user-role', 'assign-user-permission', 'remove-user-permission', 'user-logs', 'user-event-history', 'approve-user', 'view-tokens', 'user-apikeys', 'user-statistics']
    },

    {   parentId: 'Full-Events', innerPermissions:
        ['view-event', 'create-event', 'modify-event', 'remove-event', 'suspend-event', 'approve-event', 'view-ticket', 'add-ticket', 'modify-ticket', 'remove-ticket', 'view-event-type', 'in-attendance','add-event-type', 'modify-event-type', 'remove-event-type', 'view-comments', 'modify-comment', 'remove-comment', 'answer-comment', 'view-likes', 'modify-likes', 'remove-likes', 'add-likes', 'view-star', 'modify-star', 'remove-star', 'add-star', 'view-author', 'modify-author', 'remove-author','subscribe-sms','event-statistics','aprove-event', 'verify-event', 'decline-event',]
    },

    {
        parentId: 'Full-Payments', innerPermissions:
        ['sold-tickets', 'view-refund', 'view-payout', 'approve-payout', 'decline-payout', 'approve-refund', 'request-payout', 'request-refund', 'payment-statistics', 'credit-user', 'initialize-payment', 'authorize-payment', 'my-approvals', 'pending-user-approvals']

    },

    {
        parentId: 'Full-Configuration', innerPermissions:
        ['sms-subscribers', 'sms', 'send-sms', 'remove-sms', 'view-email', 'send-email', 'remove-email', 'users-concerns', 'answer-concern', 'decline-concern', 'advertisements', 'add-advert', 'modify-advert', 'remove-advert', 'approve-advert', 'api-routes', 'add-routes', 'modify-routes', 'remove-routes', 'access-documentations', 'access-policy', 'access-about-us', 'messages', 'reply-message', 'remove-message']
    }



];


// Toggle visibility for each section
sections.forEach(section => toggleElementBasedOnPermission(section.parentId, section.innerPermissions));


document.addEventListener('DOMContentLoaded', function () {
    if (!hasPermission('request-promotion')) {
        document.getElementById('request-promotion').style.display = 'none';
    }
    if (!hasPermission('request-new-contract')) {
        document.getElementById('request-new-contract').style.display = 'none';
    }

    if (hasPermission('Developer-Option')) {
        document.getElementById('request-new-contract').style.display = 'block';
        document.getElementById('request-promotion').style.display = 'block';
    }

    someCustomFunction();

});

// Additional functions or logic
function someCustomFunction() {
    console.log('Executing some custom function.');
}

