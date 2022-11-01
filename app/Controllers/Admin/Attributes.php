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
        ];

		if ($this->attributeModel->save($params)) {
			$this->session->setFlashdata('success', 'attribute has been updated!');
			return redirect()->to('/admin/attributes');
		} else {
			$this->getAttributes();
            $this->data['attribute'] = $this->attributeModel->find($id);
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