CREATE VIEW bank_employee_view AS
SELECT
    bank.bank_name as bank_name,
    bank.account_number as account_number,
    employee.id as employee_id,
    employee.code as employee_code,
    employee.name as employee_name
FROM bank_accounts bank
LEFT JOIN employees employee ON bank.employee_id = employee.id;

CREATE VIEW payslip_employee_banks_view AS
SELECT
    payslips.id as payslip_id,
    employee.name as employee_name,
    ba.account_number as bank_number,
    ba.bank_name as bank_name,
    payslips.start_date as start_date,
    payslips.end_date as end_date,
    COALESCE(payslips.deduction,0) as deduction,
    COALESCE(payslips.bonus,0) as bonus,
    COALESCE(payslips.payslip_amount,0) as total
FROM payslips
LEFT JOIN employees employee on payslips.employee_id = employee.id
LEFT JOIN bank_accounts ba on payslips.bank_account_id = ba.id;