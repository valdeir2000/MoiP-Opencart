<?php 
class ControllerPaymentMoip extends Controller {
    private $error = array(); 

    public function index() {
        $this->load->language('payment/moip');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->load->model('setting/setting');

            $this->model_setting_setting->editSetting('moip', $this->request->post);				

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');

        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_test'] = $this->language->get('entry_test');
        $this->data['entry_razao'] = $this->language->get('entry_razao');
        $this->data['entry_apitoken'] = $this->language->get('entry_apitoken');
        $this->data['entry_apikey'] = $this->language->get('entry_apikey');
        $this->data['entry_notify'] = $this->language->get('entry_notify');
        $this->data['entry_autorizdo'] = $this->language->get('entry_autorizdo');
        $this->data['entry_iniciado'] = $this->language->get('entry_iniciado');
        $this->data['entry_boletoimpresso'] = $this->language->get('entry_boletoimpresso');
        $this->data['entry_concluido'] = $this->language->get('entry_concluido');
        $this->data['entry_cancelado'] = $this->language->get('entry_cancelado');
        $this->data['entry_emanalise'] = $this->language->get('entry_emanalise');
        $this->data['entry_estornado'] = $this->language->get('entry_estornado');
        $this->data['entry_revisao'] = $this->language->get('entry_revisao');
        $this->data['entry_reembolsado'] = $this->language->get('entry_reembolsado');
        
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');	

        $this->data['entry_order_status'] = $this->language->get('entry_order_status');		

        $this->data['help_razao'] = $this->language->get('help_razao');
        $this->data['help_notify'] = $this->language->get('help_notify');
		$this->data['help_autorizado'] = $this->language->get('help_autorizado');
        $this->data['help_iniciado'] = $this->language->get('help_iniciado');
        $this->data['help_boletoimpresso'] = $this->language->get('help_boletoimpresso');
        $this->data['help_concluido'] = $this->language->get('help_concluido');
        $this->data['help_cancelado'] = $this->language->get('help_cancelado');
        $this->data['help_emanalise'] = $this->language->get('help_emanalise');
        $this->data['help_estornado'] = $this->language->get('help_estornado');
        $this->data['help_revisao'] = $this->language->get('help_revisao');
        $this->data['help_reembolsado'] = $this->language->get('help_reembolsado');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['error_email'] = $this->language->get('error_email');

        $this->document->breadcrumbs = array();

        $this->document->breadcrumbs[] = array(
            'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
            'text'      => $this->language->get('text_home'),
            'separator' => FALSE
        );

        $this->document->breadcrumbs[] = array(
            'href'      => HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'],
            'text'      => $this->language->get('text_payment'),
            'separator' => ' :: '
        );

        $this->document->breadcrumbs[] = array(
            'href'      => HTTPS_SERVER . 'index.php?route=payment/moip&token=' . $this->session->data['token'],
            'text'      => $this->language->get('heading_title'),
            'separator' => ' :: '
        );

        $this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/moip&token=' . $this->session->data['token'];

        $this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];

        if (isset($this->request->post['moip_status'])) {
            $this->data['moip_status'] = $this->request->post['moip_status'];
        } else {
            $this->data['moip_status'] = $this->config->get('moip_status'); 
        }
		
		if (isset($this->request->post['moip_notify'])) {
            $this->data['moip_notify'] = $this->request->post['moip_notify'];
        } else {
            $this->data['moip_notify'] = $this->config->get('moip_notify'); 
        } 

        if (isset($this->request->post['moip_email'])) {
            $this->data['moip_email'] = $this->request->post['moip_email'];
        } else {
            $this->data['moip_email'] = $this->config->get('moip_email'); 
        } 

        if (isset($this->request->post['moip_test'])) {
            $this->data['moip_test'] = $this->request->post['moip_test'];
        } else {
            $this->data['moip_test'] = $this->config->get('moip_test'); 
        } 

        if (isset($this->request->post['moip_razao'])) {
            $this->data['moip_razao'] = $this->request->post['moip_razao'];
        } else {
            $this->data['moip_razao'] = $this->config->get('moip_razao');
        }
        
        //apitoken
        if (isset($this->request->post['moip_apitoken'])) {
            $this->data['moip_apitoken'] = $this->request->post['moip_apitoken'];
        } else {
            $this->data['moip_apitoken'] = $this->config->get('moip_apitoken');
        }
        
       //apikey
        if (isset($this->request->post['moip_apikey'])) {
            $this->data['moip_apikey'] = $this->request->post['moip_apikey'];
        } else {
            $this->data['moip_apikey'] = $this->config->get('moip_apikey');
        }
		
		//Autorizado
        if (isset($this->request->post['moip_apikey'])) {
            $this->data['moip_autorizado'] = $this->request->post['moip_autorizado'];
        } else {
            $this->data['moip_autorizado'] = $this->config->get('moip_autorizado');
        }
		
		//Iniciado
        if (isset($this->request->post['moip_iniciado'])) {
            $this->data['moip_iniciado'] = $this->request->post['moip_iniciado'];
        } else {
            $this->data['moip_iniciado'] = $this->config->get('moip_iniciado');
        }
		
		//Boleto Impresso
        if (isset($this->request->post['moip_boletoimpresso'])) {
            $this->data['moip_boletoimpresso'] = $this->request->post['moip_boletoimpresso'];
        } else {
            $this->data['moip_boletoimpresso'] = $this->config->get('moip_boletoimpresso');
        }
		
		//Concluido
        if (isset($this->request->post['moip_concluido'])) {
            $this->data['moip_concluido'] = $this->request->post['moip_concluido'];
        } else {
            $this->data['moip_concluido'] = $this->config->get('moip_concluido');
        }
		
		//Cancelado
        if (isset($this->request->post['moip_cancelado'])) {
            $this->data['moip_cancelado'] = $this->request->post['moip_cancelado'];
        } else {
            $this->data['moip_cancelado'] = $this->config->get('moip_cancelado');
        }
		
		//Em Análise
        if (isset($this->request->post['moip_emanalise'])) {
            $this->data['moip_emanalise'] = $this->request->post['moip_emanalise'];
        } else {
            $this->data['moip_emanalise'] = $this->config->get('moip_emanalise');
        }
		
		//Estornado
        if (isset($this->request->post['moip_estornado'])) {
            $this->data['moip_estornado'] = $this->request->post['moip_estornado'];
        } else {
            $this->data['moip_estornado'] = $this->config->get('moip_estornado');
        }
		
		//Em Revisão
        if (isset($this->request->post['moip_revisao'])) {
            $this->data['moip_revisao'] = $this->request->post['moip_revisao'];
        } else {
            $this->data['moip_revisao'] = $this->config->get('moip_revisao');
        }
		
		//Reembolsado
        if (isset($this->request->post['moip_reembolsado'])) {
            $this->data['moip_reembolsado'] = $this->request->post['moip_reembolsado'];
        } else {
            $this->data['moip_reembolsado'] = $this->config->get('moip_reembolsado');
        }
        
           

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['moip_geo_zone_id'])) {
            $this->data['moip_geo_zone_id'] = $this->request->post['moip_geo_zone_id'];
        } else {
            $this->data['moip_geo_zone_id'] = $this->config->get('moip_geo_zone_id'); 
        } 

        if (isset($this->request->post['moip_order_status_id'])) {
            $this->data['moip_order_status_id'] = $this->request->post['moip_order_status_id'];
        } else {
            $this->data['moip_order_status_id'] = $this->config->get('moip_order_status_id'); 
        } 

        //status do pedido quando estive aguardando pagamento pelo moip
        if (isset($this->request->post['moip_aguardando'])) {
            $this->data['moip_aguardando'] = $this->request->post['moip_aguardando'];
        } else {
            $this->data['moip_aguardando'] = $this->config->get('moip_aguardando'); 
        } 
        //estatos do pedido quando for cancelado pelo moip
        if (isset($this->request->post['moip_cancelado'])) {
            $this->data['moip_cancelado'] = $this->request->post['moip_cancelado'];
        } else {
            $this->data['moip_cancelado'] = $this->config->get('moip_cancelado'); 
        } 
        //status do pedido quando for aprovando pelo moip
        if (isset($this->request->post['moip_aprovado'])) {
            $this->data['moip_aprovado'] = $this->request->post['moip_aprovado'];
        } else {
            $this->data['moip_aprovado'] = $this->config->get('moip_aprovado'); 
        } 
        //status do pedido quando for Analize pelo moip
        if (isset($this->request->post['moip_analize'])) {
            $this->data['moip_analize'] = $this->request->post['moip_analize'];
        } else {
            $this->data['moip_analize'] = $this->config->get('moip_analize'); 
        } 
        //status do pedido quando for Completo pelo moip
        if (isset($this->request->post['moip_completo'])) {
            $this->data['moip_completo'] = $this->request->post['moip_completo'];
        } else {
            $this->data['moip_completo'] = $this->config->get('moip_completo'); 
        } 

        $this->load->model('localisation/order_status');

        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['moip_status'])) {
            $this->data['moip_status'] = $this->request->post['moip_status'];
        } else {
            $this->data['moip_status'] = $this->config->get('moip_status');
        }

        if (isset($this->request->post['moip_sort_order'])) {
            $this->data['moip_sort_order'] = $this->request->post['moip_sort_order'];
        } else {
            $this->data['moip_sort_order'] = $this->config->get('moip_sort_order');
        }

        $this->id       = 'content';
        $this->template = 'payment/moip.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'payment/moip')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
		
		if (!$this->request->post['moip_apitoken']) {
			$this->error['erro_apitoken'] = $this->language->get('erro_apitoken');
		}
		
		if (!$this->request->post['moip_apikey']) {
			$this->error['erro_apikey'] = $this->language->get('erro_apikey');
		}

        if (!@$this->request->post['moip_razao']) {
            $this->error['error_razao'] = $this->language->get('error_razao');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }	
    }
}
?>
