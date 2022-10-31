<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\AttributeModel;

class Attributes extends BaseController
{
    protected $attributeModel;
    protected $perPage  = 10;

    public function __construct()
    {
        $this->attributeModel = new AttributeModel();

        $this->data['attributeTypes'] = $this->attributeModel::ATTRIBUTE_TYPES;
        $this->data['isRequiredOptions'] = $this->attributeModel::IS_REQUIRED_OPTIONS;
        $this->data['isUniqueOptions'] = $this->attributeModel::IS_UNIQUE_OPTIONS;
        $this->data['validations'] = $this->attributeModel::VALIDATIONS;
        $this->data['isConfigurableOptions'] = $this->attributeModel::IS_CONFIGURABLE_OPTIONS;
        $this->data['isFilterableOptions'] = $this->attributeModel::IS_FILTERABLE_OPTIONS;

        $this->data['currentAdminMenu'] = 'catalogue';
        $this->data['currentAdminSubMenu'] = 'attribute';
    }

    public function index($attributeId = null)
    {
        if ($attributeId) {
            $attribute = $this->attributeModel->find($attributeId);
            if (!$attribute) {
                $this->session->setFlashdata('errors', 'Invalid attribute');
                return redirect()->to('/admin/attributes');
            }

            $this->data['attribute'] = $attribute;
        }

        $this->getAttributes();

        return view('admin/attributes/index', $this->data);
    }

    private function getAttributes()
    {
        $this->data['attributes'] = $this->attributeModel->paginate($this->perPage, 'bootstrap');
        $this->data['pager'] = $this->attributeModel->pager;
    }

    public function store()
    {
        $request = \Config\Services::request();
        $params = [
            'code' => $request->getVar('code'),
            'name' => $request->getVar('name'),
            'type' => $request->getVar('type'),
            'is_required' => $request->getVar('is_required'),
            'is_unique' => $request->getVar('is_unique'),
            'validation' => $request->getVar('validation'),
            'is_configurable' => $request->getVar('is_configurable'),
            'is_filterable' => $request->getVar('is_filterable'),
        ];

        if ($this->attributeModel->save($params)) {
            $this->session->setFlashdata('success', 'attribute has been saved.');
            return redirect()->to('/admin/attributes');
        } else {
            $this->getAttributes();
            $this->data['errors'] = $this->attributeModel->errors();
            return view('admin/attributes/index', $this->data);
        }
    }

    public function update($id)
    {
        $request = \Config\Services::request();
        $params = [
			'id' => $id,
            'code' => $request->getVar('code'),
            'name' => $request->getVar('name'),
            'type' => $request->getVar('type'),
            'is_required' => $request->getVar('is_required'),
            'is_unique' => $request->getVar('is_unique'),
            'validation' => $request->getVar('validation'),
            'is_configurable' => $request->getVar('is_configurable'),
            'is_filterable' => $request->getVar('is_filterable'),
        ];

		if ($this->attributeModel->save($params)) {
			$this->session->setFlashdata('success', 'attribute has been updated!');
			return redirect()->to('/admin/attributes');
		} else {
			$this->getAttributes();
			$this->data['errors'] = $this->attributeModel->errors();
			return view('admin/attributes/index', $this->data);
		}
    }

    public function destroy($id)
    {
        $attribute = $this->attributeModel->find($id);
		if (!$attribute) {
			$this->session->setFlashdata('errors', 'Invalid attribute');
			return redirect()->to('/admin/attributes');
		}

		if ($this->attributeModel->delete($attribute->id)) {
			$this->session->setFlashdata('success', 'The attribute has been deleted');
			return redirect()->to('/admin/attributes');
		} else {
			$this->session->setFlashdata('errors', 'Could not delete the attribute');
			return redirect()->to('/admin/attributes');
		}
    }
}