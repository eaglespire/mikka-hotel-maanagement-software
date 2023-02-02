<?php

namespace App\Services;

class Permissions
{
    public const CAN_CREATE_BOOKING = 'create-booking';
    public const CAN_UPDATE_BOOKING = 'update-booking';
    public const CAN_DELETE_BOOKING = 'delete-booking';
    public const CAN_READ_BOOKINGS = 'read-bookings';

    public const CAN_CREATE_CUSTOMER = 'create-customer';
    public const CAN_UPDATE_CUSTOMER = 'update-customer';
    public const CAN_DELETE_CUSTOMER = 'delete-customer';
    public const CAN_READ_CUSTOMERS = 'read-customers';

    public const CAN_CREATE_ROOM = 'create-room';
    public const CAN_UPDATE_ROOM = 'update-room';
    public const CAN_DELETE_ROOM = 'delete-room';
    public const CAN_READ_ROOMS = 'read-rooms';

    public const CAN_CREATE_EMPLOYEE = 'create-employee';
    public const CAN_UPDATE_EMPLOYEE = 'update-employee';
    public const CAN_DELETE_EMPLOYEE = 'delete-employee';
    public const CAN_READ_EMPLOYEES = 'read-employees';

    public const CAN_CREATE_ROLE = 'create-role';
    public const CAN_UPDATE_ROLE = 'update-role';
    public const CAN_DELETE_ROLE = 'delete-role';
    public const CAN_READ_ROLES = 'read-roles';

    public const CAN_CREATE_BLOG_POST = 'create-blog-post';
    public const CAN_UPDATE_BLOG_POST = 'update-blog-post';
    public const CAN_DELETE_BLOG_POST = 'delete-blog-post';
    public const CAN_READ_BLOG_POSTS = 'read-blog-posts';

    public const CAN_DOWNLOAD_INVOICE = 'download-invoice';
    public const CAN_READ_INVOICES = 'read-invoices';
    public const CAN_UPDATE_INVOICE = 'update-invoice';
    public const CAN_DELETE_INVOICE = 'delete-invoice';

    public const CAN_CREATE_EXPENSE = 'create-expense';
    public const CAN_UPDATE_EXPENSE = 'update-expense';
    public const CAN_DELETE_EXPENSE = 'delete-expense';
    public const CAN_READ_EXPENSES = 'read-expenses';

    public const CAN_CREATE_PAYROLL = 'create-payroll';
    public const CAN_UPDATE_PAYROLL = 'update-payroll';
    public const CAN_DELETE_PAYROLL = 'delete-payroll';
    public const CAN_READ_PAYROLLS = 'read-payrolls';

    public const CAN_CREATE_ASSET = 'create-asset';
    public const CAN_UPDATE_ASSET = 'update-asset';
    public const CAN_DELETE_ASSET = 'delete-asset';
    public const CAN_READ_ASSETS = 'read-assets';

    public const CAN_READ_ACTIVITIES = 'read-activities';
    public const CAN_DELETE_ACTIVITY = 'delete-activity';

    public const CAN_CREATE_EXPENSE_REPORT = 'create-expense-report';
    public const CAN_UPDATE_EXPENSE_REPORT = 'update-expense-report';
    public const CAN_DELETE_EXPENSE_REPORT = 'delete-expense-report';
    public const CAN_READ_EXPENSE_REPORT = 'read-expense-report';

    public const CAN_CREATE_INVOICE_REPORT = 'create-invoice-report';
    public const CAN_UPDATE_INVOICE_REPORT = 'update-invoice-report';
    public const CAN_DELETE_INVOICE_REPORT = 'delete-invoice-report';
    public const CAN_READ_INVOICE_REPORT = 'read-invoice-report';

    public const CAN_MANAGE_SETTINGS = 'manage-settings';

}
