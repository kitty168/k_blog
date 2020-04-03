<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/22
 * Time: 上午1:27
 * Created by 18php.com
 */

namespace app\admin\controller;


use app\facade\SiteConfigModel;

class SiteConfig extends Base
{

    /**
     * @return string|\think\response\Json
     * @throws \Exception
     */
    public function index(){
        $id = 1;

        if($this->request->isPost()){
            $data = $this->buildParams();
            $data['id'] = $id;

            if(SiteConfigModel::update($data)){
                return $this->apiReturn(200,'操作成功');
            }
            return $this->apiReturn(300,'操作失败');
        }

        $info = SiteConfigModel::getInfo(1);

        $this->assign('info', $info);

        return $this->fetch();
    }


    protected function buildParams()
    {
        $data['site_title']      = input('post.site_title/s', '');
        $data['keyword']         = input('post.keyword/s', '');
        $data['description']     = input('post.description/s', '');
        $data['copyright']       = input('post.copyright/s', '');
        $data['icp']             = input('post.icp/s', '');
        $data['tel']             = input('post.tel/s', '');
        $data['mobile']          = input('post.mobile/s', '');
        $data['hot_tel']         = input('post.hot_tel/s', '');
        $data['email']           = input('post.email/s', '');
        $data['fax']             = input('post.fax/s', '');
        $data['address']         = input('post.address/s', '');
        $data['logo']            = input('post.logo/s', '');
        $data['code2']           = input('post.code2/s', '');
        $data['script_code']     = input('post.script_code/s', '');
        $data['smtp_host']       = input('post.smtp_host/s', '');
        $data['smtp_port']       = input('post.smtp_port/s', '');
        $data['email_account']   = input('post.email_account/s', '');
        $data['email_pwd']       = input('post.email_pwd/s', '');
        $data['email_recipient'] = input('post.email_recipient/s', '');
        $data['page_list_rows']  = input('post.page_list_rows/s', '');
        $data['theme']           = input('post.theme/s', 'default');

        return $data;
    }



}