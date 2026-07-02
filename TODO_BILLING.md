# Billing Fix Notes

Billing was static and referenced non-existent Billing/Invoice tables.

This fix makes Billing functional by:
- Loading appointments from `appointments` table.
- Computing a deterministic invoice amount per appointment.
- Marking status as Paid/Unpaid using a simple rule (appointment id parity).

No schema changes are required; once Billing/Invoice tables are added, controller can be adapted.
