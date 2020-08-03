<?php

defined('BASEPATH') or exit('No direct script access allowed');

class npi_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();

    }



    /**
     * Get lead
     * @param  string $id Optional - leadid
     * @return mixed
     */

    public function get($where = [])
    {
        $this->select();
        $this->join();
        $this->db->where($where);

        return $this->db->get(db_prefix() . 'npi_bulk')->result_array();
    }

    public function get_taxnomy($id = false)
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get(db_prefix() . 'taxnomy_code')->row();
        }

           $this->db->order_by('Tax_Name', 'asc');

          return $this->db->get(db_prefix() . 'taxnomy_code')->result_array();
    }




    public function add_log($insert_id)
    {
        /*if (isset($data['custom_contact_date']) || isset($data['custom_contact_date'])) {
            if (isset($data['contacted_today'])) {
                $data['lastcontact'] = date('Y-m-d H:i:s');
                unset($data['contacted_today']);
            } else {
                $data['lastcontact'] = to_sql_date($data['custom_contact_date'], true);
            }
        }

        if (isset($data['is_public']) && ($data['is_public'] == 1 || $data['is_public'] === 'on')) {
            $data['is_public'] = 1;
        } else {
            $data['is_public'] = 0;
        }

        if (!isset($data['country']) || isset($data['country']) && $data['country'] == '') {
            $data['country'] = 0;
        }

        if (isset($data['custom_contact_date'])) {
            unset($data['custom_contact_date']);
        }

        $data['description'] = nl2br($data['description']);
        $data['dateadded']   = date('Y-m-d H:i:s');
        $data['addedfrom']   = get_staff_user_id();

        $data = hooks()->apply_filters('before_lead_added', $data);

        $tags = '';
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }

        $data['address'] = trim($data['address']);
        $data['address'] = nl2br($data['address']);

        $data['email'] = trim($data['email']);
        $this->db->insert(db_prefix() . 'leads', $data);
        $insert_id = $this->db->insert_id();*/

            log_activity('New Lead Added [ID: ' . $insert_id . ']');
            $this->log_lead_activity($insert_id, 'not_lead_activity_created');

            handle_tags_save($tags, $insert_id, 'lead');

            if (isset($custom_fields)) {
                handle_custom_fields_post($insert_id, $custom_fields);
            }

            //$this->lead_assigned_member_notification($insert_id, $data['assigned']);
            hooks()->do_action('lead_created', $insert_id);

            return $insert_id;

    }

     public function log_lead_activity($id, $description, $integration = false, $additional_data = '')
    {
        $log = [
            'date'            => date('Y-m-d H:i:s'),
            'description'     => $description,
            'leadid'          => $id,
            'staffid'         => get_staff_user_id(),
            'additional_data' => $additional_data,
            'full_name'       => get_staff_full_name(get_staff_user_id()),
        ];
        if ($integration == true) {
            $log['staffid']   = 0;
            $log['full_name'] = '[CRON]';
        }

        $this->db->insert(db_prefix() . 'lead_activity_log', $log);

        return $this->db->insert_id();
    }
     public function lead_assigned_member_notification($lead_id, $assigned, $integration = false)
    {
        if ((!empty($assigned) && $assigned != 0)) {
            if ($integration == false) {
                if ($assigned == get_staff_user_id()) {
                    return false;
                }
            }

            $name = $this->db->select('name')->from(db_prefix() . 'leads')->where('id', $lead_id)->get()->row()->name;

            $notification_data = [
                'description'     => ($integration == false) ? 'not_assigned_lead_to_you' : 'not_lead_assigned_from_form',
                'touserid'        => $assigned,
                'link'            => '#leadid=' . $lead_id,
                'additional_data' => ($integration == false ? serialize([
                    $name,
                ]) : serialize([])),
            ];

            if ($integration != false) {
                $notification_data['fromcompany'] = 1;
            }

            if (add_notification($notification_data)) {
                pusher_trigger_notification([$assigned]);
            }

            $this->db->select('email');
            $this->db->where('staffid', $assigned);
            $email = $this->db->get(db_prefix() . 'staff')->row()->email;

            send_mail_template('lead_assigned', $lead_id, $email);

            $this->db->where('id', $lead_id);
            $this->db->update(db_prefix() . 'leads', [
                'dateassigned' => date('Y-m-d'),
            ]);

            $not_additional_data = [
                get_staff_full_name(),
                '<a href="' . admin_url('profile/' . $assigned) . '" target="_blank">' . get_staff_full_name($assigned) . '</a>',
            ];

            if ($integration == true) {
                unset($not_additional_data[0]);
                array_values(($not_additional_data));
            }

            $not_additional_data = serialize($not_additional_data);

            $not_desc = ($integration == false ? 'not_lead_activity_assigned_to' : 'not_lead_activity_assigned_from_form');
            $this->log_lead_activity($lead_id, $not_desc, $integration, $not_additional_data);
        }
    }
}
