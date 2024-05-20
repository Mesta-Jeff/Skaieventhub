
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
        ['view-event', 'create-event', 'modify-event', 'remove-event', 'suspend-event', 'approve-event', 'view-ticket', 'add-ticket', 'modify-ticket', 'remove-ticket', 'view-event-type', 'add-event-type', 'modify-event-type', 'remove-event-type', 'view-comments', 'modify-comment', 'remove-comment', 'answer-comment', 'view-likes', 'modify-likes', 'remove-likes', 'add-likes', 'view-star', 'modify-star', 'remove-star', 'add-star', 'view-author', 'modify-author', 'remove-author','subscribe-sms','event-statistics']

    },

    {
        parentId: 'Full-Payments', innerPermissions:
        ['sold-tickets', 'view-refund', 'view-payout', 'approve-payout', 'decline-payout', 'approve-refund', 'request-payout', 'request-refund', 'payment-statistics', 'credit-user', 'initialize-payment', 'authorize-payment', 'my-approvals', 'pending-user-approvals']

    },

    {
        parentId: 'Full-Configuration', innerPermissions:
        ['sms-subscribers', 'sms', 'send-sms', 'remove-sms', 'email', 'send-email', 'remove', 'users-concerns', 'answer-concern', 'decline-concern', 'advertisements', 'add-advert', 'modify-advert', 'remove-advert', 'approve-advert', 'api-routes', 'add-routes', 'modify-routes', 'remove-routes', 'documentations', 'policy', 'about-us', 'messages', 'reply-message', 'remove-message']

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









// var userPermissions = ['love', 'sickness', 'solomon','Developer-Options'];

// function hasPermission(permission) {
//     return userPermissions.includes(permission);
// }

// function hideElementIfNoPermission(permissionId) {
//     if (!hasPermission(permissionId)) {
//         document.getElementById(permissionId).style.display = 'none';
//     }
// }

// function handlePermissions() {

//     // Full Permissions
//     if (hasPermission('Developer-Option')) {

//         return;
//     }


//     // Full Settings
//     hideElementIfNoPermission('Full-Settings');
//     hideElementIfNoPermission('Full-Workers');
//     hideElementIfNoPermission('Full-Contracts');
//     hideElementIfNoPermission('Full-Requests');
//     hideElementIfNoPermission('Full-Leaves');
//     hideElementIfNoPermission('Full-Attendances');
//     hideElementIfNoPermission('Full-Loans');
//     hideElementIfNoPermission('Full-Payslips');


//     // System Settings
//     const systemPermissions = [
//         'view-roles', 'view-permissions', 'set-contract', 'set-payslip', 'set-leave',
//         'set-leave-claims', 'set-days', 'set-attendance-time', 'effect-casual-off',
//         'view-groups', 'view-factory', 'configure-system',      'request-promotion', 'request-bank-statement'
//     ];
//     systemPermissions.forEach(permission => hideElementIfNoPermission(permission));

//     // Workers Management
//     const workersPermissions = [
//         'view-casual-workers', 'view-contract-workers', 'view-permanent-workers',
//         'assign-worker-permission', 'effect-promotion'
//     ];
//     workersPermissions.forEach(permission => hideElementIfNoPermission(permission));

//     // Contract Manager
//     const contractManagerPermissions = [
//         'sign-contract', 'terminate-contract', 'pending-contract-request',
//         'contract-review', 'batch-assignment', 'issue-contract-statement',
//         'extend-contract-individual', 'extend-group-contract'
//     ];
//     contractManagerPermissions.forEach(permission => hideElementIfNoPermission(permission));

//     // Requests
//     const requestsPermissions = [
//         'attendance-list', 'workers-records', 'requested-loans', 'account-minute',
//         'promotion-claims', 'leave-claims', 'excuse-duties', 'requested-days'
//     ];
//     requestsPermissions.forEach(permission => hideElementIfNoPermission(permission));

//     // Leave Management
//     const leaveManagementPermissions = [
//         'leave-requests', 'requests-days', 'pending-leaves', 'due-leaves',
//         'enforce-leave', 'reschedule-leave'
//     ];
//     leaveManagementPermissions.forEach(permission => hideElementIfNoPermission(permission));

//     // Attendance Manager
//     const attendanceManagerPermissions = [
//         'upload-attendance', 'remark-attendance', 'review-attendance',
//         'check-days-worker', 'check-group-days', 'days-claims', 'generate-timetable'
//     ];
//     attendanceManagerPermissions.forEach(permission => hideElementIfNoPermission(permission));

//     // Loan
//     const loanPermissions = ['process-loan', 'approve-loan', 'loan-statements'];
//     loanPermissions.forEach(permission => hideElementIfNoPermission(permission));

//     // Payslip
//     const payslipPermissions = [
//         'approve-payslip', 'financial-ticket', 'generate-pincode', 'prepare-payslip',
//         'release-salary', 'release-pincode', 'verify-payslip', 'view-slip-ticket',
//         'withheld-payslip'
//     ];
//     payslipPermissions.forEach(permission => hideElementIfNoPermission(permission));

// }


// // Call the function on page load
// document.addEventListener('DOMContentLoaded', function () {
//     handlePermissions();
// });

