<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-12-17 03:37:09 --> Query error: Unknown column 'product_description' in 'field list' - Invalid query: INSERT INTO `ci_job` (`name`, `details`, `price`, `agents`, `job_category`, `jobid`, `status`, `customer_id`, `job_currency`, `created_at`, `company_id`, `billing_party`, `shipment`, `commercial_invoices`, `loading_point`, `delivery_point`, `product_description`, `qty`, `weight`, `slug`) VALUES ('Krishna', 'test', '1000', 'MY-0001', 'Export', 'JBE2212056', 'processing', 'cuskr1001', 'Local Currency', '2022-12-17', 'com14111', '', 'TRACKER', 'CVN123', 'TESTER', 'adasd', 'product test', '12', '200GM', 'krishna')
ERROR - 2022-12-17 08:54:05 --> Severity: error --> Exception: Too few arguments to function Vendorinvoice::jobbycompany_id(), 0 passed in /home/bi23oe5w/public_html/invoicev2/system/core/CodeIgniter.php on line 532 and exactly 1 expected /home/bi23oe5w/public_html/invoicev2/application/controllers/admin/Vendorinvoice.php 117
