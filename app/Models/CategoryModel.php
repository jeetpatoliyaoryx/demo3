<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = "category";

    static function get_single($id)
    {
        return self::find($id);
    }

    static public function getSlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    static public function getParentCategory($parent_id)
    {
        return self::where('parent_id', '=', $parent_id)->get();
    }

    static public function getParentCategoryAdmin($parent_id)
    {
        return self::where('parent_id', '=', $parent_id)->where('status', '=', 0)->get();
    }

    static public function getHomeCategory($parent_id = 0)
    {
        return self::where('status', '=', 0)->where('parent_id', '=', $parent_id)->get();
        //return self::where('parent_id','=',$parent_id)->get();
    }


    public function subcategoryBackend()
    {
        return $this->hasMany(CategoryModel::class, "parent_id");
    }


    public function subcategory()
    {
        return $this->hasMany(CategoryModel::class, "parent_id")->where('status', 0);
    }

    static public function getSlugCategory($slugArray)
    {
        return self::whereIn('slug', $slugArray)->get();
    }

    static public function get_search_categories($search)
    {
        //return self::where('status','=',0)->where('name','like','%'.$search.'%')->limit(20)->get();
        return self::where('name', 'like', '%' . $search . '%')->limit(20)->get();
    }

    public function getparent()
    {
        return $this->belongsTo(CategoryModel::class, "parent_id", "id");
    }


    public function getCategoryImage()
    {
        if (!empty($this->category_image) && file_exists('upload/category_image/' . $this->category_image)) {
            return url('upload/category_image/' . $this->category_image);
        } else {
            return url('upload/category_image/default.jpg');
        }
    }

    public function getCategoryBannerImage()
    {
        if (!empty($this->category_banner_image) && file_exists('upload/category_image/' . $this->category_banner_image)) {
            return url('upload/category_image/' . $this->category_banner_image);
        } else {
            return url('upload/category_image/b_default.jpg');
        }
    }

    static public function getAllCategory($category_id)
    {
        $first_category_id = 0;
        $second_category_id = 0;
        $last_category_id = 0;

        $category = CategoryModel::get_single($category_id);
        $last_category_id = $category_id;
        if (!empty($category->parent_id)) {
            $main_category = CategoryModel::get_single($category->parent_id);
            $second_category_id = $main_category->id;
            if (!empty($main_category->parent_id)) {
                $main_main_category = CategoryModel::get_single($main_category->parent_id);

                $first_category_id = $main_main_category->id;
            }
        }

        $data = array();
        if (!empty($first_category_id)) {
            $data[] = $first_category_id;
        }
        if (!empty($second_category_id)) {
            $data[] = $second_category_id;
        }
        if (!empty($last_category_id)) {
            $data[] = $last_category_id;
        }

        return $data;
    }

    static public function getCategoryID($slug)
    {
        $data = array();
        $category = CategoryModel::getSlug($slug);
        if (!empty($category)) {
            $data[] = $category->id;
            $subcategory = CategoryModel::where('parent_id', '=', $category->id)->pluck('id')->toArray();
            $subsubcategory = CategoryModel::whereIn('parent_id', $subcategory)->pluck('id')->toArray();
            return array_merge($data, $subcategory, $subsubcategory);
        } else {
            return array();
        }
    }

    static function getCategoryFirstFilter($cate1)
    {
        $category = CategoryModel::getSlug($cate1);
        if (!empty($category)) {
            $getCategory = CategoryModel::getHomeCategory($category->id);

            $result = array();

            foreach ($getCategory as $value) {
                $data['url'] = url('c/' . $cate1 . '/' . $value->slug);
                $data['slug'] = $value->slug;
                $data['name'] = $value->name;
                $result[] = $data;
            }

            return $result;
        } else {
            abort(404);
        }
    }

    static public function getCategorySecondFilter($cate1, $cate2)
    {
        $category = CategoryModel::getSlug($cate2);
        if (!empty($category)) {
            $getCategory = CategoryModel::getHomeCategory($category->id);
            $result = array();

            foreach ($getCategory as $value) {
                $data['url'] = url('c/' . $cate1 . '/' . $cate2 . '/' . $value->slug);
                $data['slug'] = $value->slug;
                $data['name'] = $value->name;
                $result[] = $data;
            }

            return $result;
        } else {
            abort(404);
        }

    }

    static public function getCategoryLastFilter($cate1, $cate2, $cate3)
    {
        $category = CategoryModel::getSlug($cate2);
        $cehckcategory = CategoryModel::getSlug($cate3);
        if (!empty($category) && !empty($cehckcategory)) {
            $getCategory = CategoryModel::getHomeCategory($category->id);
            $result = array();

            foreach ($getCategory as $value) {
                $data['url'] = url('c/' . $cate1 . '/' . $cate2 . '/' . $value->slug);
                $data['slug'] = $value->slug;
                $data['name'] = $value->name;
                $data['id'] = $value->id;
                $result[] = $data;
            }

            return $result;
        } else {
            abort(404);
        }
    }

    static public function getCategoryParent($category_id)
    {
        $urllast = '';
        $urlsecond = '';
        $urlfirst = '';
        $result = array();
        $LastCategory = CategoryModel::get_single($category_id);
        if (!empty($LastCategory->parent_id)) {
            $SecondCategory = CategoryModel::get_single($LastCategory->parent_id);
            if (!empty($SecondCategory)) {
                $firstCategory = CategoryModel::get_single($SecondCategory->parent_id);
                if (!empty($firstCategory)) {
                    $urlfirst = $firstCategory->slug;

                    $data['id'] = $firstCategory->id;
                    $data['slug'] = $firstCategory->slug;
                    $data['name'] = $firstCategory->name;
                    $data['url'] = url('c/' . $firstCategory->slug);
                    $result[] = $data;
                }

                $urlsecond = $SecondCategory->slug;

                $data['id'] = $SecondCategory->id;
                $data['slug'] = $SecondCategory->slug;
                $data['name'] = $SecondCategory->name;
                if (!empty($urlfirst)) {
                    $data['url'] = url('c/' . $urlfirst . '/' . $SecondCategory->slug);
                } else {
                    $data['url'] = url('c/' . $SecondCategory->slug);
                }
                $result[] = $data;
            }

            $urllast = $LastCategory->slug;

            $data['id'] = $LastCategory->id;
            $data['slug'] = $LastCategory->slug;
            $data['name'] = $LastCategory->name;

            if (!empty($urlfirst)) {
                $data['url'] = url('c/' . $urlfirst . '/' . $urlsecond . '/' . $LastCategory->slug);
            } else {
                if (!empty($urlsecond)) {
                    $data['url'] = url('c/' . $urlsecond . '/' . $LastCategory->slug);
                } else {
                    $data['url'] = url('c/' . $LastCategory->slug);
                }
            }

            $result[] = $data;
        }

        return $result;
    }


    static public function getCategoryParentURL($category_id)
    {
        $urllast = '';
        $urlsecond = '';
        $urlfirst = '';
        $result = array();
        $LastCategory = CategoryModel::get_single($category_id);
        if (!empty($LastCategory->parent_id)) {
            $SecondCategory = CategoryModel::get_single($LastCategory->parent_id);
            if (!empty($SecondCategory)) {
                $firstCategory = CategoryModel::get_single($SecondCategory->parent_id);
                if (!empty($firstCategory)) {
                    $urlfirst = $firstCategory->slug;
                }
                $urlsecond = $SecondCategory->slug;
            }
        }

        $urllast = $LastCategory->slug;

        if (!empty($urlfirst)) {
            $url = url('c/' . $urlfirst . '/' . $urlsecond . '/' . $urllast);
        } else {
            if (!empty($urlsecond)) {
                $url = url('c/' . $urlsecond . '/' . $urllast);
            } else {
                $url = url('c/' . $urllast);
            }
        }

        return $url;
    }

    public static function getParentHierarchy($id)
    {
        $chain = [];
        while ($id) {
            $cat = self::find($id);
            if (!$cat)
                break;
            $chain[] = $cat->id;
            $id = $cat->parent_id;
        }
        return array_reverse($chain);
    }
    



}
